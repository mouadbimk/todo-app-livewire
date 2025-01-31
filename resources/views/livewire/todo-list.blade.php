{{-- <div class="container w-100 mx-auto">
    <h1 class="text-white bg-sky-500 text-2xl text-center mg-10 p-5">Todo List | Laravel & Livewire</h1>
    <div class="box rounded border-t-2 border-sky-500 m-10 mx-50">
        <div class="title text-xl">Create New Todo</div>
        <h3>* Todo</h3>
        <form action="">
            <input type="text" placeholder="Todo....">
        @error('todo')
            <p class="text-red-500 m-3">{{$message}}</p>
        @enderror
        <button>Create +</button>
        </form>
    </div>
</div> --}}
<div>


<div id="head" class="flex border-blue-800 border-t-2">
    <div class="w-full">
        <header class="flex bg-white justify-between h-20 border-b border-b-gray-200 items-center px-6">
            <div id="left-header" class="">
            </div>
            <div id="right-header" class="text-gray-800 hover:text-gray-600 space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </header>
    </div>
</div>
@if(session('success'))
<span class="text-white rounded bg-green-500 p-3 fixed top-10 right-10">{{session('success')}}</span>
@endif
<div id="content" class="mx-auto" style="max-width:500px;">
    @include('livewire.includes.create')
    @include('livewire.includes.search')
    @foreach ($todos as $todo )
    @include('livewire.includes.list',['todo' => $todo])
    @endforeach
    <div class="my-2">
        <!-- Pagination goes here -->
        {{ $todos->links() }}
        </div>
</div>
</div>

