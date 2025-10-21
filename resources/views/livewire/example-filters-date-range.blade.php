<div class="bx">
    <div class="bx-title">Date Range Filter Implementation Options</div>
    <div class="bx-content">
        <p>There are several ways to implement filter buttons. All methods use values from the <code>DateRange</code> enum for consistency and type safety. </p>
        {{-- default is created_at but can pass 3rd param to define another --}}
        <pre><x-torchlight-code language="blade">@verbatim
            <x-gt-button wire:click="setFilter('date_range', 'enum_value', 'db_column')"/>
        @endverbatim </x-torchlight-code></pre>
        <hr>
        <div>
            <div class="bx-title">Manually pick specific filters you want to display</div>
            <div>
                <x-gt-button wire:click="setFilter('date_range', 'today')" text="Today" class="xs cyan" />
                <x-gt-button wire:click="setFilter('date_range', 'last7')" text="Last 7 Days" class="xs cyan" />
                <x-gt-button wire:click="setFilter('date_range', 'thisMonth')" text="This Month" class="xs cyan" />
                <x-gt-button wire:click="setFilter('date_range', 'lastMonth')" text="Last Month" class="xs cyan" />
                <x-gt-button wire:click="setFilter('date_range', 'thisYear')" text="This Year" class="xs cyan" />
                <x-gt-button wire:click="setFilter('date_range', 'lastYear')" text="Last Year" class="xs cyan" />
                <x-gt-button wire:click="setFilter('date_range', 'custom')" text="Custom" class="xs cyan" disabled />
            </div>
            <pre><x-torchlight-code language="blade">@verbatim
                <x-gt-button wire:click="setFilter('date_range', 'today')" text="Today" />
                <x-gt-button wire:click="setFilter('date_range', 'last7')" text="Last 7 Days" />
                <x-gt-button wire:click="setFilter('date_range', 'thisMonth')" text="This Month" />
                <x-gt-button wire:click="setFilter('date_range', 'lastMonth')" text="Last Month" />
                <x-gt-button wire:click="setFilter('date_range', 'thisYear')" text="This Year" />
                <x-gt-button wire:click="setFilter('date_range', 'lastYear')" text="Last Year" />
                <x-gt-button wire:click="setFilter('date_range', 'custom')" text="Custom" />
            @endverbatim </x-torchlight-code></pre>
        </div>
        <hr>
        <div>
            <div class="bx-title">Loop - Define a subset of enum values in an array</div>
            <div>
                @foreach (['today', 'thisMonth', 'lastMonth'] as $value)
                    <x-gt-button wire:click="setFilter('date_range', '{{ $value }}')"
                        text="{{ \Naykel\Gotime\Enums\DateRange::from($value)->label() }}" class="xs teal" />
                @endforeach
            </div>
            <!-- prettier-ignore-start -->
            <pre><x-torchlight-code language="blade">@verbatim
                @foreach (['today', 'thisMonth', 'lastMonth'] as $value)
                    <x-gt-button wire:click="setFilter('date_range', '{{ $value }}')"
                        text="{{ \Naykel\Gotime\Enums\DateRange::from($value)->label() }}" />
                @endforeach
            @endverbatim </x-torchlight-code></pre>
            <!-- prettier-ignore-end -->
        </div>
        <hr>
        <div>
            <div class="bx-title">Loop - Automatically display all enum cases</div>
            <div>
                @foreach (\Naykel\Gotime\Enums\DateRange::cases() as $range)
                    <x-gt-button wire:click="setFilter('date_range', '{{ $range->value }}')"
                        class="xs rose" text="{{ $range->label() }}" />
                @endforeach
            </div>
            <!-- prettier-ignore-start -->
            <pre><x-torchlight-code language="blade">@verbatim
                @foreach (\Naykel\Gotime\Enums\DateRange::cases() as $range)
                    <x-gt-button wire:click="setFilter('date_range', '{{ $range->value }}')" 
                        class="xs rose" text="{{ $range->label() }}" />
                @endforeach
            @endverbatim </x-torchlight-code></pre>
            <!-- prettier-ignore-end -->
        </div>
        <hr>
        <div>
            <div class="bx-title">Select Dropdown - Space-efficient alternative for many options</div>
            <div>
                <select wire:change="setFilter('date_range', $event.target.value)" class="xs">
                    @foreach (\Naykel\Gotime\Enums\DateRange::cases() as $range)
                        <option value="{{ $range->value }}">{{ $range->label() }} </option>
                    @endforeach
                </select>
            </div>
            <!-- prettier-ignore-start -->
            <pre><x-torchlight-code language="blade">@verbatim
                <select wire:change="setFilter('date_range', $event.target.value)">
                    @foreach (\Naykel\Gotime\Enums\DateRange::cases() as $range)
                        <option value="{{ $range->value }}">{{ $range->label() }} </option>
                    @endforeach
                </select>
            @endverbatim </x-torchlight-code></pre>
            <!-- prettier-ignore-end -->
        </div>
        <hr>
        <div>
            <div class="bx-title">Setting active state class on buttons</div>
            <div>
                @foreach (['today', 'thisMonth', 'lastMonth'] as $value)
                    @php $isActive = isset($filters['date_range']) && $filters['date_range'] === $value; @endphp
                    <x-gt-button wire:click="setFilter('date_range', '{{ $value }}')"
                        text="{{ \Naykel\Gotime\Enums\DateRange::from($value)->label() }}"
                        @class(['xs', 'red' => $isActive, 'green' => !$isActive]) />
                @endforeach
            </div>
            <!-- prettier-ignore-start -->
            <pre><x-torchlight-code language="blade">@verbatim
                @foreach (['today', 'thisMonth', 'lastMonth'] as $value)
                    @php $isActive = isset($filters['date_range']) && $filters['date_range'] === $value; @endphp
                    <x-gt-button wire:click="setFilter('date_range', '{{ $value }}')"
                        text="{{ \Naykel\Gotime\Enums\DateRange::from($value)->label() }}"
                        @class(['xs', 'red' => $isActive, 'green' => !$isActive]) />
                @endforeach
            @endverbatim </x-torchlight-code></pre>
            <!-- prettier-ignore-end -->
        </div>
    </div>
</div>
