<div x-data="{ calculated: @entangle('calculated') }" class="flex flex-col gap-10 py-10">
    <div>
        <h2 class="block text-lg font-bold ">
            Try creating your own recipe:
        </h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full bg-white shadow-lg rounded-lg p-8">
        <div class="flex flex-col gap-4">
            <div>
                <h2 class="block text-sm font-medium text-gray-700">Teaspoons remaining:</h2>
                <p>
                    {{ $teaspoons_remaining }}
                </p>
            </div>
            <div>
                <label for="sprinkles" class="block text-sm font-medium text-gray-700">Sprinkles</label>
                <div class="mt-1">
                    <input wire:model="sprinkles_amount" type="number" name="sprinkles" id="sprinkles"
                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                           min="0" max="100" placeholder="Number of teaspoons">
                </div>
            </div>
            <div>
                <label for="butterscotch" class="block text-sm font-medium text-gray-700">Butterscotch</label>
                <div class="mt-1">
                    <input wire:model="butterscotch_amount" type="number" name="butterscotch" id="butterscotch"
                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                           min="0" max="100" placeholder="Number of teaspoons">
                </div>
            </div>
            <div>
                <label for="chocolate" class="block text-sm font-medium text-gray-700">Chocolate</label>
                <div class="mt-1">
                    <input wire:model="chocolate_amount" type="number" name="chocolate" id="chocolate"
                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                           min="0" max="100" placeholder="Number of teaspoons">
                </div>
            </div>
            <div>
                <label for="candy" class="block text-sm font-medium text-gray-700">Candy</label>
                <div class="mt-1">
                    <input wire:model="candy_amount" type="number" name="candy" id="candy"
                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                           min="0" max="100" placeholder="Number of teaspoons">
                </div>
            </div>
        </div>
        <div>
            <div>
                <h2 class="block text-lg font-bold ">
                    Output:
                </h2>
            </div>
            @if(!array_key_exists('total', $result) || $result['total'] === 0 || $teaspoons_remaining < 0)
                <div>
                    Invalid recipe
                </div>
                @if($sprinkles_amount === 0 || $butterscotch_amount === 0 || $chocolate_amount === 0 || $candy_amount === 0)
                    <div>
                        - Must add atleast 1 teaspoon of every ingredient
                    </div>
                @endif
                @if($teaspoons_remaining > 0)
                    <div>
                        - Must add exactly 100 teaspoons
                    </div>
                @endif
                @if($teaspoons_remaining < 0)
                    <div>
                        - Can't add more than 100 teaspoons
                    </div>
                @endif
            @else
                @foreach($result as $key => $value)
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            {{ $key }}
                        </div>
                        <div>
                            {{ $value }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div>
        <h2 class="block text-lg font-bold ">
            Or calculate the max total score & max total score with 500 calories:
        </h2>
    </div>
    <button class="px-4 py-2 bg-emerald-200 rounded-md" type="button" wire:click="calculateMax">
        <span wire:loading.remove wire:target="calculateMax">Calculate Max Total Score</span>
        <span wire:loading wire:target="calculateMax">Calculating</span>
        <svg wire:loading wire:target="calculateMax"
             class="mr-2 w-8 h-8 text-gray-200 animate-spin text-white fill-emerald-600"
             viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor"/>
            <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentFill"/>
        </svg>
    </button>
    <div x-show="calculated" class="p-8 bg-white shadow-lg rounded-lg">
        <div>
            <h2 class="block text-lg font-bold ">
                Max possible score:
            </h2>
        </div>
        @foreach($maxValue as $key => $value)
            <div class="grid grid-cols-2 gap-2">
                <div>
                    {{ $key }}
                </div>
                <div>
                    {{ $value }}
                </div>
            </div>
        @endforeach
    </div>
    <div x-show="calculated" class="p-8 bg-white shadow-lg rounded-lg">
        <div>
            <h2 class="block text-lg font-bold ">
                Max possible score with 500 calorie cookies:
            </h2>
        </div>
        @foreach($maxValueWithCalories as $key => $value)
            <div class="grid grid-cols-2 gap-2">
                <div>
                    {{ $key }}
                </div>
                <div>
                    {{ $value }}
                </div>
            </div>
        @endforeach
    </div>
    <script>
        document.addEventListener('log', (data) => {
            console.log(data.detail)
        })
    </script>
</div>
