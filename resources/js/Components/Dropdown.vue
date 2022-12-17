<script setup>
import { ref } from 'vue';


const active = ref(false)
</script>

<template>
    <div class="relative">
        <!-- Dropdown Toggler -->
        <div @click="active = !active" class="cursor-pointer">
            <slot name="toggler" />
        </div>

        <!-- Dropdown Overlay -->
        <div class="inset-0 fixed z-40" @click="active = false" v-if="active"></div>
    
        <!-- Dropdown Menu -->
        <Transition 
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform scale-90 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-90 opacity-0" >
            <div 
                @click="active = false"
                v-show="active"
                style="display: none;"
                class="absolute z-50 w-56 min-w-max mt-2 right-0 origin-top-right rounded-lg shadow-lg">
                <div class="py-1 bg-white rounded-lg ring-1 ring-black ring-opacity-5">
                    <slot name="menu"/>
                </div>
            </div>
        </Transition>
    </div>
</template>