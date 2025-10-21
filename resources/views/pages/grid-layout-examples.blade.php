<x-layouts.app title="Grid Layout Examples" class="red">
    <section class="my-0 pxy flex gap bg-blue-50">
        <div class="fg1 bdr-5">
            <div class="grid gap-0 layout-sidebar-left">
                <header class="pxy bdr-4 bdr-red"> HEADER </header>
                <aside class="pxy bdr-4 bdr-blue sidebar"> SIDEBAR </aside>
                <main class="pxy bdr-4 bdr-green"> MAIN </main>
            </div>
        </div>
        <div class="w-sm">
            <!-- prettier-ignore-start -->
            <pre><x-torchlight-code language="blade">@verbatim
                <div class="grid gap-0 layout-sidebar-left">
                    <header class="pxy"> HEADER </header>
                    <aside class="pxy sidebar"> SIDEBAR </aside>
                    <main class="pxy"> MAIN </main>
                </div>
            @endverbatim </x-torchlight-code></pre>
            <pre><x-torchlight-code language="css">@verbatim
                .layout-sidebar-left {
                    grid-template-columns: 250px 1fr;
                    grid-template-rows: auto 1fr auto;
                    grid-template-areas:
                        'sidebar header'
                        'sidebar main'
                        'sidebar footer';
                }
            @endverbatim </x-torchlight-code></pre>
            <!-- prettier-ignore-end -->
        </div>
    </section>

    <section class="my-0 pxy flex gap bg-gray-50">
        <div class="w-sm">
            <!-- prettier-ignore-start -->
            <pre><x-torchlight-code language="blade">@verbatim
                <div class="layout-holy-grail">
                    <header class="pxy"> </header>
                    <aside class="pxy sidebar-left"> </aside>
                    <main class="pxy"> </main>
                    <aside class="pxy sidebar-right"> </aside>
                    <footer class="pxy"> </footer>
                </div>
            @endverbatim </x-torchlight-code></pre>
            <pre><x-torchlight-code language="css">@verbatim
                .layout-holy-grail {
                    display: grid;
                    min-height: 100vh;
                    grid-template-columns: 250px 1fr 250px;
                    grid-template-rows: auto 1fr auto;
                    grid-template-areas:
                        'header header header'
                        'sidebar-left main sidebar-right'
                        'footer footer footer';
                }
            @endverbatim </x-torchlight-code></pre>
            <!-- prettier-ignore-end -->
        </div>
        <div class="fg1 bdr-5">
            <div class="layout-holy-grail">
                <header class="pxy bdr-4 bdr-red"> HEADER </header>
                <aside class="pxy bdr-4 bdr-blue sidebar-left"> SIDEBAR-LEFT </aside>
                <main class="pxy bdr-4 bdr-green"> MAIN </main>
                <aside class="pxy bdr-4 bdr-purple sidebar-right"> SIDEBAR-RIGHT </aside>
                <footer class="pxy bdr-4 bdr-yellow"> FOOTER </footer>
            </div>
        </div>
    </section>
</x-layouts.app>
