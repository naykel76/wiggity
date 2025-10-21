<x-layouts.sidebar-left title="Dev">

    <div class="grid gap-0 layout-sidebar-left minh-screen">
        <aside class="pxy sidebar bg-stone-900">

            <a class="relative flex items-center gap-3 rounded-lg  py-0 text-start w-full px-3 my-px text-zinc-500 dark:text-white/80 data-current:text-(--color-accent-content) hover:data-current:text-(--color-accent-content) data-current:bg-white dark:data-current:bg-white/[7%] data-current:border data-current:border-zinc-200 dark:data-current:border-transparent hover:text-zinc-800 dark:hover:text-white dark:hover:bg-white/[7%] hover:bg-zinc-800/5  border border-transparent"
                data-flux-navlist-item="data-flux-navlist-item" wire:navigate="">
                <div class="relative">
                    <svg class="shrink-0 [:where(&amp;)]:size-6 size-4!" data-flux-icon="" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                        data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25">
                        </path>
                    </svg>
                </div>

                <div class="flex-1 text-sm font-medium leading-none whitespace-nowrap [[data-nav-footer]_&amp;]:hidden [[data-nav-sidebar]_[data-nav-footer]_&amp;]:block"
                    data-content="">Dashboard</div>
            </a>

            <x-gt-menu filename="nav-main" menuname="main" />
        </aside>
        <main class="pxy bg-stone-800"> MAIN </main>
    </div>

    {{--  --}}
    {{-- 
    ```css
    grid-template-columns: 250px 1fr;
    grid-template-areas: "sidebar main";

    @media (max-width: 768px) {
    grid-template-columns: 1fr;
    grid-template-areas: "main" "sidebar";
    }
    ``` --}}

    {{-- <div class="grid grid-container">
        <aside class="x-sidebar pxy flex-centered bg-stripe-yellow">
            <div>
                <div class="dark py-025 px-05 mb-025">SIDEBAR</div>
                <div class="txt-xs txt-red">250px fixed</div>
            </div>
        </aside>
        <main class="x-main pxy flex-centered bg-stripe-gray">
            <div>
                <div class="dark py-025 px-05 mb-025">MAIN CONTENT</div>
                <div class="txt-xs txt-red">1fr (flexible)</div>
            </div>
        </main>
    </div> --}}
    {{-- <style>
        .grid-container {
            grid-template-columns: 250px 1fr;
            grid-template-rows: auto 1fr auto;
            grid-template-areas:
                "sidebar main aside"
                "footer footer footer";
            min-height: 600px;
        }

        .x-header {
            grid-area: header;
        }

        .x-sidebar {
            grid-area: sidebar;
        }

        .x-main {
            grid-area: main;

        }

        .x-aside {
            grid-area: aside;
        }

        .x-footer {
            grid-area: footer;
        }

        /* Tablet */
        @media (max-width: 1024px) {
            .grid-container {
                grid-template-columns: 200px 1fr;
                grid-template-areas:
                    "header header"
                    "sidebar main"
                    "sidebar aside"
                    "footer footer";
            }
        }

        /* Mobile */
        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "header"
                    "main"
                    "sidebar"
                    "aside"
                    "footer";
            }

            .x-sidebar,
            .x-aside {
                min-height: 150px;
            }
        }
    </style> --}}
</x-layouts.sidebar-left>
