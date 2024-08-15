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
        <x-left-sidebar />

        <!-- Right Content -->
        <div class="right-content grow">
            <!-- Content Header -->
            <x-header title="Dashboard" />

            <!-- Toast Container -->
            <div class="toast-container px-8 pt-3">
                <!-- The toast of failed. -->
                <!-- <div class="toast toast-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M256,48C141.31,48,48,141.31,48,256s93.31,208,208,208,208-93.31,208-208S370.69,48,256,48Zm75.31,260.69a16,16,0,1,1-22.62,22.62L256,278.63l-52.69,52.68a16,16,0,0,1-22.62-22.62L233.37,256l-52.68-52.69a16,16,0,0,1,22.62-22.62L256,233.37l52.69-52.68a16,16,0,0,1,22.62,22.62L278.63,256Z" />
                    </svg>
                    <p>
                        Custom your message!
                    </p>
                </div> -->

                <!-- The toast of succesed. -->
                <!-- <div class="toast toast-success">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M256,48C141.31,48,48,141.31,48,256s93.31,208,208,208,208-93.31,208-208S370.69,48,256,48ZM364.25,186.29l-134.4,160a16,16,0,0,1-12,5.71h-.27a16,16,0,0,1-11.89-5.3l-57.6-64a16,16,0,1,1,23.78-21.4l45.29,50.32L339.75,165.71a16,16,0,0,1,24.5,20.58Z" />
                    </svg>
                    <p>
                        Custom your message!
                    </p>
                </div> -->
            </div>

            <main class="p-8 pt-5">

                <h1>Dashboard</h1>

                <div class="content">

                    <table class="border-table info-table">
                        <tbody>
                            <tr>
                                <td class="w-1/2">
                                    <h3>Route 1</h3>
                                    <ul class="p-2 pt-0 route-list">
                                        @foreach($campuses as $campus)
                                            <li>
                                                <h4 class="font-normal">Campus {{ $campus->letter }} </h4>
                                                <div class="route-truckers">
                                                    <h5 class="mb-1">Truckers:</h5>
                                                    @forelse ($campus->fr_truckers as $trucker)
                                                        <div class="mb-2">
                                                            <div class="route-info">
                                                                <div>- {{ $trucker->first_name }} {{ $trucker->last_name }}</div>
                                                                <div class="ml-2 badge badge-indigo">{{ $trucker->plate }}</div>
                                                            </div>
                                                            <div class="text-xs pl-2">{{ $trucker->arrived_date }}</div>
                                                        </div>
                                                    @empty
                                                        <div class="text-xs text-gray-400">No trucker in the campus.</div>
                                                    @endforelse
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="w-1/2">
                                    <h3>Route 2</h3>
                                    <ul class="p-2 pt-0 route-list">
                                        @foreach($campuses->reverse() as $campus)
                                            <li>
                                                <h4 class="font-normal">Campus {{ $campus->letter }} </h4>
                                                <div class="route-truckers">
                                                    <h5 class="mb-1">Truckers:</h5>
                                                    @forelse ($campus->sr_truckers as $trucker)
                                                        <div class="mb-2">
                                                            <div class="route-info">
                                                                <div>- {{ $trucker->first_name }} {{ $trucker->last_name }}</div>
                                                                <div class="ml-2 badge badge-indigo">{{ $trucker->plate }}</div>
                                                            </div>
                                                            <div class="text-xs pl-2">{{ $trucker->arrived_date }}</div>
                                                        </div>
                                                    @empty
                                                        <div class="text-xs text-gray-400">No trucker in the campus.</div>
                                                    @endforelse
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

</body>

</html>
