<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="min-h-full">
          <div class="grow flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
              <div>
                <img class="h-60 items-center w-auto m-auto" src="{{ asset('assets/images/bewama-logo.png') }}" alt="Your Company">
                <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
                <p class="mt-2 text-sm leading-6 text-gray-500">
                  Not a member?
                  <a href="{{ route('register') }}" class="font-semibold text-primary hover:text-primary-700 hover:underline">Sign-up</a>
                </p>
              </div>

              <div class="mt-10">
                <div>
                  <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                      <label for="email" class="block  text-sm font-medium leading-6 text-gray-900">Email address</label>
                      <div class="mt-2">
                        <x-bewama::form.input.text name="email" type="email" placeholder="Please fill your email"></x-bewama::form.input.text>
                      </div>
                    </div>
                    <div>
                      <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                      <div class="mt-2">
                        <x-bewama::form.input.text name="password" type="password" placeholder="Please fill your password"></x-bewama::form.input.text>
                      </div>
                    </div>

                    <div class="flex items-center justify-between">
                      <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-700">Remember me</label>
                      </div>

                      <div class="text-sm leading-6">
                        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                      </div>
                    </div>

                    <div class="">
                      <button type="submit" class="inline-flex bg-green-500 p-2 rounded-lg !text-white hover:bg-green-600">
                          Sign in
                          <svg class="-ml-0.5 h-5 w-5 m-auto ms-1" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                          </svg>
                      </button>
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
        </div>
</x-guest-layout>
