<x-layouts.app :$title>

    <section class="bg-blue-950 py-5-3-2 txt-white">
        <div class="container-md tac">
            <h1 class="txt-3 ">Show, don't tell.</h1>
            <p class="lead">A living, action-based reference for building with Laravel Livewire and Gotime</p>
            <p class="lead fw6 mt-0">Real examples, no waffle, ready to copy, tweak, and ship.</p>
        </div>
    </section>



    <div class="container py">
        <div class="grid cols-4">
            <div class="bx">
                <x-gt-menu filename="nav-main" menuname="dashboard" withIcons />
            </div>
            <div class="bx">
                <x-gt-menu filename="nav-main" menuname="dashboard" class="menu" withIcons />
            </div>
     
        </div>
    </div>
    
           <div class="navbar">
                <x-gt-menu filename="nav-main" menuname="dashboard" withIcons />
            </div>
</x-layouts.app>
