<?php

namespace App\Livewire;
use App\Models\Todo;
use Exception;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    #[Rule('required|string|min:3|max:50')]
    public $name = '';
    public $search = '';
    public $EditingTodoID;

    #[Rule('required|string|min:3|max:50')]
    public $EditingTodoName;

    public function create(){
      //validate
      $validate = $this->validateOnly('name');
      //create todo in database
      Todo::create($validate);
      //clear input
      $this->reset('name');
      //send flash message
      request()->session()->flash('message', 'Todo created Successfully');
      $this->resetPage();
    }
    public function delete($todoID){
        try{
            Todo::findOrFail($todoID)->delete();
            request()->session()->flash('success', 'Todo deleted Successfully');


        }catch(Exception $e){
            request()->session()->flash('error','Failed To Delete Todo!');
            return;
        }
    }
    public function update(){
        //find Todo
        $this->validateOnly('EditingTodoName');
        //update todo in database
        Todo::find($this->EditingTodoID)->update(['name'=>$this->EditingTodoName]);
        //clear input
        $this->reset('EditingTodoID','EditingTodoName');
        //send flash message
        request()->session()->flash('success','Todo Name Updated Successfully');
    }
    public function cancelEdit(){
        $this->reset('EditingTodoID','EditingTodoName');
    }
    public function toggle($todoID){
        $todo = Todo::find($todoID);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function edit($todoID){
        $this->EditingTodoID = $todoID;
        $this->EditingTodoName = Todo::find($todoID)->name;

    }
    public function render()
    {
        $todos = Todo::where('name','like',"%{$this->search}%")->orderBy('created_at','desc')->paginate(5);
        return view('livewire.todo-list',[
            'todos' => $todos,
        ]);
    }
}
