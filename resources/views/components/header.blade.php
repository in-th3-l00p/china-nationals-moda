<header class="flex justify-between shadow-sm px-8 py-4">
    <div class="content-header-left text-gray-500">
        {{ $title }}
    </div>
    <div class="flex items-end content-header-right text-sm">
        <div class="mr-3 text-stone-800">{{ request()->user()->username }}</div>
        <a href={{ route("logout") }} class="logout-func">Logout</a>
    </div>
</header>
