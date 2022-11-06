@props(['isBookingPage' => false])
<div wire:ignore x-data="pincode" @reset-otp.window="reset()">
    <div class="flex items-center gap-1 {{ $isBookingPage == false ? 'justify-center' : 'justify-start' }}">
        <template x-for="i in length" :key="i">
            <input type="text" :name="'pin'+i" maxlength="1" @paste.prevent="paste(event)" @keydown="type(event,i)" @keydown.ctrl.a.prevent @mousemove.prevent.stop @keydown.arrow-right.prevent="goto(i+1)" @keydown.arrow-left.prevent="goto(i-1)" :value="input[i-1] != null ? input[i-1] : ''" :x-ref="'pin'+i" :disabled="input.length < i-1" autofocus="i==1" pattern="[0-9]*" autocomplete="off" class="bg-lime-50 hover:border-lime-400 border-lime-300 focus:outline-none focus:bg-white focus:ring-1 focus:ring-lime-300 inline w-10 py-2 text-4xl text-center transition duration-300 border rounded-md select-none" inputmode="numeric">
        </template>
    </div>
</div>
