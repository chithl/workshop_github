<div class="w-full max-w-md">
    <div class="bg-white rounded-lg shadow-xl p-8">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-full mb-4">
                <i class="fas fa-coffee text-white text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Đăng Nhập</h2>
            <p class="text-gray-600 mt-2">Quản lý Quán Cà Phê</p>
        </div>

        <!-- Login Form -->
        <form action="#" method="POST" class="space-y-6">
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" id="email" name="email" required
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="email@example.com">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Mật Khẩu
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password" required
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Ghi nhớ đăng nhập</span>
                </label>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">
                    Quên mật khẩu?
                </a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition duration-200">
                <i class="fas fa-sign-in-alt mr-2"></i> Đăng Nhập
            </button>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Hoặc đăng nhập với</span>
                </div>
            </div>

            <!-- Social Login -->
            <div class="grid grid-cols-2 gap-3">
                <button type="button" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    Google
                </button>
                <button type="button" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fab fa-facebook text-blue-600 mr-2"></i>
                    Facebook
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Chưa có tài khoản? 
            <a href="index.php?page=register" class="text-indigo-600 hover:text-indigo-500 font-medium">
                Đăng ký ngay
            </a>
        </p>
    </div>

    <!-- Footer -->
    <p class="text-center text-sm text-gray-500 mt-6">
        © 2024 Coffee Shop Management. All rights reserved.
    </p>
</div>
