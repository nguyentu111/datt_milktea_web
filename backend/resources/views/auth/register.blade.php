<x-guest-layout>
  <div class="flex min-h-full">
    <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full max-w-sm lg:w-96">
        <div>
          <img class="h-10 items-center w-auto m-auto" src="{{ asset('assets/images/coffeeter-logo.png') }}" alt="Coffeeter logo">
          <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign up your account</h2>
          <p class="mt-2 text-sm leading-6 text-gray-500">
            Register new account for using website services.
          </p>
        </div>

        <div class="mt-10">
          <div>
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
              @csrf
              <div>
                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('First name') }}</label>
                <div class="mt-2">
                  <x-bewama::form.input.text id="first_name" name="first_name" type="text" value="{{old('first_name')}}" placeholder="Please fill your first name"></x-bewama::form.input.text>
                  <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-error" />
                </div>
              </div>
              <div>
                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Last name') }}</label>
                <div class="mt-2">
                  <x-bewama::form.input.text id="last_name" name="last_name" type="text" value="{{old('last_name')}}" placeholder="Please fill your last name"></x-bewama::form.input.text>
                  <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-error" />
                </div>
              </div>
              <div>
                <label for="email" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Gender') }}</label>
                <div class="mt-2 flex gap-4">
                  <!-- <x-bewama::form.input.text name="email" type="email" placeholder="Please fill your email"></x-bewama::form.input.text>
                  <x-input-error :messages="$errors->get('email')" class="mt-2 text-error" /> -->
                  <div class="flex gap-2 items-center">
                    <input id="male" name="gender" value="male" type='radio' checked />
                    <label for="male">Male</label>
                  </div>
                  <div class="flex gap-2 items-center">
                    <input id="female" name="gender" value="female" type='radio' />
                    <label for="female">Femail</label>
                  </div>
                </div>
              </div>

              <div>
                <label for="dob" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Email') }}</label>
                <div class="mt-2">
                  <x-bewama::form.input.text name="email" type="email" placeholder="Please fill your email" value="{{old('email')}}"></x-bewama::form.input.text>
                  <x-input-error :messages="$errors->get('email')" class="mt-2 text-error" />
                </div>
              </div>

              <div>
                <label for="dob" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Date of birth') }}</label>
                <div class="mt-2">
                  <x-bewama::form.input.text name="dob" type="date" placeholder="dd-mm-yyyy" value=""></x-bewama::form.input.text>
                  <x-input-error :messages="$errors->get('dob')" class="mt-2 text-error" />
                </div>
              </div>

              <div>
                <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Phone number') }}</label>
                <div class="mt-2">
                  <x-bewama::form.input.text name="phone" type="text" placeholder="Please fill your phone number" value="{{old('phone')}}"></x-bewama::form.input.text>
                  <x-input-error :messages="$errors->get('phone_number')" class="mt-2 text-error" />
                </div>
              </div>

              <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Password') }}</label>
                <div class="mt-2">
                  <x-bewama::form.input.text name="password" type="password" placeholder="Please fill your password"></x-bewama::form.input.text>
                  <x-input-error :messages="$errors->get('password')" class="mt-2 text-error" />
                </div>
              </div>

              <div>
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Confirm password') }}</label>
                <div class="mt-2">
                  <x-bewama::form.input.text name="password_confirmation" type="password" placeholder="Please confirm your password"></x-bewama::form.input.text>
                  <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-error" />
                </div>
              </div>


              <div>
                <x-bewama::form.button.primary type="submit">
                  <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                  </svg>
                  Sign up
                </x-bewama::form.button.primary>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <div class="relative hidden w-0  flex-1 lg:block">
      <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="">
    </div>
  </div>
  </div>
</x-guest-layout>