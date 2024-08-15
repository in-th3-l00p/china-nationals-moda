<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/fonts.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="h-full">

    <div class="flex h-full">
        <!-- Left Sidebar -->
        <div class="left-sidebar">
            <!-- Brand -->
            <div class="mb-5 px-2">
                <img class="h-7" src="assets/imgs/logo-white.png" alt="Your Company">
            </div>
            <!-- Menu List -->
            <nav class="text-indigo-200 text-sm font-medium stroke-indigo-200">
                <!-- Menu Item -->
                <div class="menu-item">
                    <a href="index.blade.php">
                        <svg class="w-6" fill="currentColor" viewBox="0 0 1024 1024" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M469.333333 614.997333l-158.165333-158.165333a42.666667 42.666667 0 0 1 60.330667-60.330667l170.666666 170.666667A42.666667 42.666667 0 0 1 554.666667 597.333333v213.333334a42.666667 42.666667 0 0 1-42.666667 42.666666H192.682667a42.666667 42.666667 0 0 1-35.456-18.944A424.832 424.832 0 0 1 85.333333 597.333333C85.333333 361.685333 276.352 170.666667 512 170.666667s426.666667 191.018667 426.666667 426.666666a424.832 424.832 0 0 1-71.893334 237.056 42.666667 42.666667 0 0 1-35.413333 18.944H682.666667a42.666667 42.666667 0 0 1 0-85.333333h125.013333a341.333333 341.333333 0 1 0-591.36 0H469.333333v-153.002667z m200.832-115.498666a42.666667 42.666667 0 0 1-60.330666-60.330667l42.666666-42.666667a42.666667 42.666667 0 0 1 60.330667 60.330667l-42.666667 42.666667zM277.333333 640a42.666667 42.666667 0 0 1 0-85.333333h42.666667a42.666667 42.666667 0 0 1 0 85.333333h-42.666667z m426.666667 0a42.666667 42.666667 0 0 1 0-85.333333h42.666667a42.666667 42.666667 0 0 1 0 85.333333h-42.666667zM469.333333 341.333333a42.666667 42.666667 0 0 1 85.333334 0v42.666667a42.666667 42.666667 0 0 1-85.333334 0V341.333333z">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                </div>
                <div class="menu-item">
                    <a href="package/list.html">
                        <svg class="w-6" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M807.168 191.189333l-187.733333-83.370666a269.397333 269.397333 0 0 0-214.954667 0l-187.733333 83.370666A213.674667 213.674667 0 0 0 85.333333 382.848v258.090667a213.674667 213.674667 0 0 0 131.498667 191.658666l187.733333 83.413334a265.429333 265.429333 0 0 0 106.325334 22.314666 2.517333 2.517333 0 0 0 2.218666 0 265.642667 265.642667 0 0 0 106.368-22.314666l187.733334-83.413334A213.674667 213.674667 0 0 0 938.666667 640.938667V382.848a213.674667 213.674667 0 0 0-131.498667-191.658667z m-222.336-5.376l187.733333 83.370667a160.128 160.128 0 0 1 16.810667 8.746667l-85.333333 37.973333L425.088 192l14.037333-6.229333a182.186667 182.186667 0 0 1 145.706667 0.042666zM320 238.933333l278.826667 123.733334-39.850667 17.706666a122.368 122.368 0 0 1-93.866667 0l-230.4-102.4a160.853333 160.853333 0 0 1 17.024-8.789333zM251.477333 754.602667A126.848 126.848 0 0 1 170.666667 640.938667V382.848a110.933333 110.933333 0 0 1 6.528-37.034667l253.141333 112.512a192.469333 192.469333 0 0 0 38.997333 12.416v376.917334a175.701333 175.701333 0 0 1-30.122666-9.642667zM853.333333 640.938667a126.848 126.848 0 0 1-80.853333 113.664l-187.733333 83.413333a177.365333 177.365333 0 0 1-30.165334 9.642667v-376.917334a192.469333 192.469333 0 0 0 38.997334-12.416l253.141333-112.512a110.933333 110.933333 0 0 1 6.613333 37.034667z"
                                fill="currentColor"></path>
                        </svg>
                        Package List
                    </a>
                </div>

                <div class="menu-item menu-active">
                    <a href="campus-list.html">
                        <svg class="w-6" viewBox="0 0 1024 1024" fill="currentColor" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M512 384a128 128 0 1 0 128 128 128 128 0 0 0-128-128z m0 170.666667a42.666667 42.666667 0 1 1 42.666667-42.666667 42.666667 42.666667 0 0 1-42.666667 42.666667z"
                                p-id="8439"></path>
                            <path
                                d="M938.666667 499.626667a85.333333 85.333333 0 0 0-85.333334-78.933334h-85.333333v-114.346666a85.333333 85.333333 0 0 0-31.573333-58.88l-184.106667-147.2-5.12-3.84a64 64 0 0 0-74.666667 3.84l-184.106666 147.2-5.76 5.12A85.333333 85.333333 0 0 0 256 313.173333v106.666667H164.266667a85.333333 85.333333 0 0 0-78.933334 85.333333V896a47.146667 47.146667 0 0 0 46.933334 42.666667H896a47.146667 47.146667 0 0 0 42.666667-46.72V499.626667zM170.666667 853.333333V506.026667h85.333333V853.333333z m170.666666-61.013333V313.173333l170.666667-136.533333 170.666667 136.533333V853.333333H341.333333z m512-91.306667V853.333333h-85.333333V506.026667h85.333333v194.986666z">
                            </path>
                        </svg>
                        Campus List
                    </a>
                </div>


                <!-- Courier Management -->
                <div class="menu-subtitle">Staff Management</div>

                <div class="menu-item">
                    <a href="staff-management/courier-list.html">
                        <svg class="w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <line x1="160" y1="144" x2="448" y2="144"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                            <line x1="160" y1="256" x2="448" y2="256"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                            <line x1="160" y1="368" x2="448" y2="368"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                            <circle cx="80" cy="144" r="16"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <circle cx="80" cy="256" r="16"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <circle cx="80" cy="368" r="16"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                        Courier List
                    </a>
                </div>
                <div class="menu-item">
                    <a href="staff-management/trucker-list.html">
                        <svg class="w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <line x1="160" y1="144" x2="448" y2="144"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                            <line x1="160" y1="256" x2="448" y2="256"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                            <line x1="160" y1="368" x2="448" y2="368"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                            <circle cx="80" cy="144" r="16"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <circle cx="80" cy="256" r="16"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <circle cx="80" cy="368" r="16"
                                style="stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                        Trucker List
                    </a>
                </div>




            </nav>
        </div>
        <!-- Right Content -->
        <div class="right-content grow">
            <!-- Content Header -->
            <header class="flex justify-between shadow-sm px-8 py-4">
                <div class="content-header-left text-gray-500">
                    Campus
                </div>
                <div class="flex items-end content-header-right text-sm">
                    <div class="mr-3 text-stone-800">username</div>
                    <a href="login.blade.php" class="logout-func">Logout</a>
                </div>
            </header>

            <!-- Toast Container -->
            <div class="toast-container px-8 pt-3">

            </div>

            <main class="p-8 pt-5">

                <h1>Campus List</h1>

                <div class="content">

                    <section class="campus-section">
                        <h2 class="mb-2 font-normal">Campus A</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="campus-card">
                                <div class="p-2 campus-card-head">
                                    <div class="font-bold flex justify-center mb-1">ID: 1</div>
                                    <div class="w-full flex justify-center">
                                        <div>
                                            Campus A
                                        </div>
                                        <div class="mx-3">
                                            --&gt;
                                        </div>
                                        <div>
                                            Campus B
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 campus-card-body">
                                    <div class="flex">
                                        <svg class="w-4 mr-2" viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M810.666667 85.333333H213.333333a128 128 0 0 0-128 128v597.333334a128 128 0 0 0 128 128h597.333334a128 128 0 0 0 128-128V213.333333a128 128 0 0 0-128-128z m-384 85.333334h170.666666v133.546666l-61.866666-42.666666a42.666667 42.666667 0 0 0-46.933334 0l-61.866666 42.666666z m426.666666 640a42.666667 42.666667 0 0 1-42.666666 42.666666H213.333333a42.666667 42.666667 0 0 1-42.666666-42.666666V213.333333a42.666667 42.666667 0 0 1 42.666666-42.666666h128v213.333333a42.666667 42.666667 0 0 0 22.613334 37.546667 42.666667 42.666667 0 0 0 42.666666-2.133334L512 349.866667l104.533333 69.546666A42.666667 42.666667 0 0 0 682.666667 384V170.666667h128a42.666667 42.666667 0 0 1 42.666666 42.666666z">
                                            </path>
                                        </svg>
                                        <div>CEAB20240101001</div>
                                    </div>
                                    <div class="flex">
                                        <svg class="w-4 mr-2" viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M810.666667 85.333333H213.333333a128 128 0 0 0-128 128v597.333334a128 128 0 0 0 128 128h597.333334a128 128 0 0 0 128-128V213.333333a128 128 0 0 0-128-128z m-384 85.333334h170.666666v133.546666l-61.866666-42.666666a42.666667 42.666667 0 0 0-46.933334 0l-61.866666 42.666666z m426.666666 640a42.666667 42.666667 0 0 1-42.666666 42.666666H213.333333a42.666667 42.666667 0 0 1-42.666666-42.666666V213.333333a42.666667 42.666667 0 0 1 42.666666-42.666666h128v213.333333a42.666667 42.666667 0 0 0 22.613334 37.546667 42.666667 42.666667 0 0 0 42.666666-2.133334L512 349.866667l104.533333 69.546666A42.666667 42.666667 0 0 0 682.666667 384V170.666667h128a42.666667 42.666667 0 0 1 42.666666 42.666666z">
                                            </path>
                                        </svg>
                                        <div>CEAB20240101002</div>
                                    </div>
                                    <div class="flex">
                                        <svg class="w-4 mr-2" viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M810.666667 85.333333H213.333333a128 128 0 0 0-128 128v597.333334a128 128 0 0 0 128 128h597.333334a128 128 0 0 0 128-128V213.333333a128 128 0 0 0-128-128z m-384 85.333334h170.666666v133.546666l-61.866666-42.666666a42.666667 42.666667 0 0 0-46.933334 0l-61.866666 42.666666z m426.666666 640a42.666667 42.666667 0 0 1-42.666666 42.666666H213.333333a42.666667 42.666667 0 0 1-42.666666-42.666666V213.333333a42.666667 42.666667 0 0 1 42.666666-42.666666h128v213.333333a42.666667 42.666667 0 0 0 22.613334 37.546667 42.666667 42.666667 0 0 0 42.666666-2.133334L512 349.866667l104.533333 69.546666A42.666667 42.666667 0 0 0 682.666667 384V170.666667h128a42.666667 42.666667 0 0 1 42.666666 42.666666z">
                                            </path>
                                        </svg>
                                        <div>CEAB20240101003</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="campus-section">
                        <h2 class="mb-2 mt-4 font-normal">Campus B</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="campus-card">
                                <div class="p-2 campus-card-head">
                                    <div class="font-bold flex justify-center mb-1">ID: { Container ID }</div>
                                    <div class="w-full flex justify-center">
                                        <div>
                                            { From Campus }
                                        </div>
                                        <div class="mx-3">
                                            --&gt;
                                        </div>
                                        <div>
                                            { To Campus }
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 campus-card-body">
                                    <div class="flex">
                                        <svg class="w-4 mr-2" viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M810.666667 85.333333H213.333333a128 128 0 0 0-128 128v597.333334a128 128 0 0 0 128 128h597.333334a128 128 0 0 0 128-128V213.333333a128 128 0 0 0-128-128z m-384 85.333334h170.666666v133.546666l-61.866666-42.666666a42.666667 42.666667 0 0 0-46.933334 0l-61.866666 42.666666z m426.666666 640a42.666667 42.666667 0 0 1-42.666666 42.666666H213.333333a42.666667 42.666667 0 0 1-42.666666-42.666666V213.333333a42.666667 42.666667 0 0 1 42.666666-42.666666h128v213.333333a42.666667 42.666667 0 0 0 22.613334 37.546667 42.666667 42.666667 0 0 0 42.666666-2.133334L512 349.866667l104.533333 69.546666A42.666667 42.666667 0 0 0 682.666667 384V170.666667h128a42.666667 42.666667 0 0 1 42.666666 42.666666z">
                                            </path>
                                        </svg>
                                        <div>{ Tracking Number }</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="campus-section">
                        <h2 class="mb-2 mt-4 font-normal">Campus C</h2>
                        <div class="grid grid-cols-4 gap-4">
                            No container in this campus now.
                        </div>
                    </section>

                    <section class="campus-section">
                        <h2 class="mb-2 mt-4 font-normal">Campus D</h2>
                        <div class="grid grid-cols-4 gap-4">
                            No container in this campus now.
                        </div>
                    </section>

                    <section class="campus-section">
                        <h2 class="mb-2 mt-4 font-normal">Campus E</h2>
                        <div class="grid grid-cols-4 gap-4">
                            No container in this campus now.
                        </div>
                    </section>

                </div>
            </main>
        </div>

    </div>

</body>

</html>
