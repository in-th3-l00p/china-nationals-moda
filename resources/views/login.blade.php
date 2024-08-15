<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/assets/fonts.css">
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-indigo-600 mx-auto w-12 rotate-45"
                viewBox="0 0 189.879 246.23">
                <path
                    d="M308.111,474.569l-48.805-20.986a7,7,0,0,0-5.531,0l-48.8,20.986a7,7,0,0,1-8.931-9.745l36.017-67L170.5,414.884a7,7,0,0,1-7.244-11.23l61.054-73.183a6.993,6.993,0,0,0,1.4-2.742l24.045-93.537a7,7,0,0,1,13.559,0l24.044,93.537a7.006,7.006,0,0,0,1.4,2.742l61.054,73.183a7,7,0,0,1-7.244,11.23l-61.555-17.056,36.017,67a6.976,6.976,0,0,1-8.931,9.745Z"
                    transform="translate(-161.602 -228.934)" />
            </svg>
            <h2 class="login-title">Sign in to your account</h2>
        </div>


        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            @error("auth")
            <div class="toast toast-danger mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M256,48C141.31,48,48,141.31,48,256s93.31,208,208,208,208-93.31,208-208S370.69,48,256,48Zm75.31,260.69a16,16,0,1,1-22.62,22.62L256,278.63l-52.69,52.68a16,16,0,0,1-22.62-22.62L233.37,256l-52.68-52.69a16,16,0,0,1,22.62-22.62L256,233.37l52.69-52.68a16,16,0,0,1,22.62,22.62L278.63,256Z" />
                </svg>
                <p>{{ $message }}</p>
            </div>
            @enderror

            <form class="space-y-6" action="{{ route("login.submit") }}" method="POST">
                @csrf

                <div>
                    <label for="username" class="login-label">Username</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="text" class="w-full">
                    </div>
                    @error("username")
                        <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="login-label">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" class="w-full">
                    </div>
                    @error("password")
                        <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="btn w-full">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
