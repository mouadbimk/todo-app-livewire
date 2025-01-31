<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    #[Rule('required|string|min:3|max:50')]
    public $name = '';
    public $search = '';

    public function create(){
      //validate
      $validate = $this->validateOnly('name');
      //create todo in database
      Todo::create($validate);
      //clear input
      $this->reset('name');
      //send flash message
      request()->session()->flash('message', 'Todo created Successfully');
    }
    public function delete($todoID){
        Todo::find($todoID)->delete();
        request()->session()->flash('success', 'Todo deleted Successfully');
    }
    public function update($todoID){
        $todo = Todo::find($todoID);
        
    }
    public function render()
    {
        $todos = Todo::where('name','like',"%{$this->search}%")->orderBy('created_at','desc')->paginate(5);
        return view('livewire.todo-list',[
            'todos' => $todos,
        ]);
    }
}
