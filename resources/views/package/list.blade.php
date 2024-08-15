<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/assets/fonts.css">
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body class="h-full">

    <div class="flex h-full">
        <!-- Left Sidebar -->
        <x-left-sidebar />

        <!-- Right Content -->
        <div class="right-content grow">

            <!-- Content Header -->
            <x-header title="Package" />


            <!-- Toast Container -->
            <div class="toast-container px-8 pt-3">

            </div>

            <main class="p-8 pt-5">

                <h1 class="flex justify-between items-center">
                    <span>Package List</span>
                </h1>

                <div class="content">

                    <!-- Package List -->
                    <div class="table-header">
                        <div class="filter">
                            <div class="filter-label">Filter by status: </div>
                            <div class="filter-terms">
                                <form>
                                    <button
                                        type="submit"
                                        @class([
                                            "link-badge badge mr-2",
                                            "link-badge-active" => request()->status === null
                                        ])
                                    >
                                        All</button>
                                </form>
                                <form>
                                    <input type="hidden" name="status" value="pending-pickup">
                                    <button
                                        type="submit"
                                        @class([
                                            "link-badge badge mr-2",
                                            "link-badge-active" => request()->status === "pending-pickup"
                                        ])
                                    >Pending pickup</button>
                                </form>
                                <form>
                                    <input type="hidden" name="status" value="picked-up">
                                    <button
                                        type="submit"
                                        @class([
                                            "link-badge badge mr-2",
                                            "link-badge-active" => request()->status === "picked-up"
                                        ])
                                    >Picked up</button>
                                </form>
                                <form>
                                    <input type="hidden" name="status" value="pending-transit">
                                    <button
                                        type="submit"
                                        @class([
                                            "link-badge badge mr-2",
                                            "link-badge-active" => request()->status === "pending-transit"
                                        ])
                                    >Pending transit</button>
                                </form>
                                <form>
                                    <input type="hidden" name="status" value="in-transit">
                                    <button
                                        type="submit"
                                        @class([
                                            "link-badge badge mr-2",
                                            "link-badge-active" => request()->status === "in-transit"
                                        ])
                                    >In transit</button>
                                </form>
                                <form>
                                    <input type="hidden" name="status" value="pending-delivery">
                                    <button
                                        type="submit"
                                        @class([
                                            "link-badge badge mr-2",
                                            "link-badge-active" => request()->status === "pending-delivery"
                                        ])
                                    >Pending delivery</button>
                                </form>
                                <form>
                                    <input type="hidden" name="status" value="delivering">
                                    <button
                                        type="submit"
                                        @class([
                                            "link-badge badge mr-2",
                                            "link-badge-active" => request()->status === "delivering"
                                        ])
                                    >Delivering</button>
                                </form>
                                <form>
                                    <input type="hidden" name="status" value="signed">
                                    <button
                                        type="submit"
                                        @class([
                                            "link-badge badge mr-2",
                                            "link-badge-active" => request()->status === "signed"
                                        ])
                                    >Signed</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Table Data -->
                    <table class="mt-2 data-table">
                        <thead class="bg-gray-0">
                            <tr>
                                <th class="w-60">No.</th>
                                <th class="w-40">From Campus</th>
                                <th class="w-40">To Campus</th>
                                <th class="w-32 ">Status</th>
                                <th class="w-12">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package->tracking_number }}</td>
                                    <td>Campus {{ $package->fromCampus->letter }}</td>
                                    <td>Campus {{ $package->toCampus->letter }}</td>
                                    <td>
                                        <div class="badge">{{ $package->status->status }}</div>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route("packages.show", [ "package" => $packages ]) }}"
                                            class="link-normal"
                                        >
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Table Footer -->
                    <div class="table-footer">
                        {{ $packages->links() }}
                    </div>

                    @if ($packages->count() === 0)
                        <p
                            class="text-gray-400"
                            style="text-align: center"
                        >
                            There are no packages
                        </p>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>

</html>
