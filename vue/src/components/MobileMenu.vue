<template>
    <Menu as="div" class="menu">
        <MenuButton> <div class="menu-logo"></div> </MenuButton
        ><Transition name="mobile-sidebar">
            <MenuItems
                class="menu-items absolute z-2 right-3 mt-2 w-56 origin-top-right divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
                <MenuItem
                    v-for="(link, idx) in links"
                    :key="idx"
                    v-slot="{ active }"
                >
                    <button
                        class="menu-button"
                        :class="[active ? 'active' : '']"
                        @click.prevent="link.click"
                    >
                        {{ link.text }}
                    </button>
                </MenuItem>
            </MenuItems></Transition
        >
    </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
const props = defineProps({ links: Array });
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;
.menu-logo {
    background-color: $main-text-color;
    -webkit-mask: url(svgs/menu-bars.svg) no-repeat center;
    -moz-mask: url(svgs/menu-bars.svg) no-repeat center;
    -ms-mask: url(svgs/menu-bars.svg) no-repeat center;
    mask: url(/svgs/menu-bars.svg) no-repeat center;
    width: 22px;
    height: 22px;
    cursor: pointer;
}

.menu {
    z-index: 200;
}

.menu-items {
    display: flex;
    flex-direction: column;
    gap: 0.5em;
    width: 20em;

    background-color: $main-bg-color;
    border-radius: 0.5em;
    border: 2px solid $main-modal-border-color;
    transform: translateX(-10%);
}

.menu-button {
    padding: 0.3em 0.7em;
    color: $secondary-text-color;
    padding-block: 0.3em;
    text-align: left;
    font-size: 1.05rem;
    transition: all 0.08s ease-in-out;
    &.active {
        background-color: $main-color;
        color: $main-text-color;
    }
}

.mobile-sidebar-enter-active,
.mobile-sidebar-leave-active {
    transition: transform 0.3s ease;
}

.mobile-sidebar-enter-active {
    animation: borderColors 0.9s steps(30) forwards;
}

.mobile-sidebar-leave-active {
    animation: borderColors 0.9s steps(30) reverse;
}

.mobile-sidebar-enter-from,
.mobile-sidebar-leave-to {
    transform: translateX(106%);
}

.mobile-sidebar-enter-to,
.mobile-sidebar-leave-from {
    transform: translateX(-10%);
    border-color: $main-modal-border-color;
}

@keyframes borderColors {
    0% {
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
    25% {
        border-top-color: $main-modal-border-color;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
    50% {
        border-top-color: $main-modal-border-color;
        border-right-color: $main-modal-border-color;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
    75% {
        border-top-color: $main-modal-border-color;
        border-right-color: $main-modal-border-color;
        border-bottom-color: $main-modal-border-color;
        border-left-color: transparent;
    }
    100% {
        border-top-color: $main-modal-border-color;
        border-right-color: $main-modal-border-color;
        border-bottom-color: $main-modal-border-color;
        border-left-color: $main-modal-border-color;
    }
}
</style>
