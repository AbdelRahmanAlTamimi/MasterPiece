<script setup>
import { ref,computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {route} from "ziggy-js";

const showingNavigationDropdown = ref(false);

const { props } = usePage();
const user = props.auth.user;
const isAdmin = computed(() => {
    return user && user.role === 'admin';
});
</script>

<template>
    <nav class="bg-black border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('home')">
                            <img src="/svg/Orange_logo.svg" alt="Logo"
                                 class="block h-9 w-auto fill-current text-gray-800"
                            />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 md:-my-px md:ms-10 md:flex">
                        <NavLink :href="route('home')" :active="route().current('home')" class="text-gray-100">
                            Forum
                        </NavLink>
                        <!-- Visible to Admins Only -->
                        <NavLink
                            v-if="isAdmin"
                            :href="route('summary')"
                            :active="route().current('summary')"
                            class="text-gray-100"
                        >
                            Summary
                        </NavLink>
                        <NavLink
                            v-if="isAdmin"
                            :href="route('users.index')"
                            :active="route().current('users')"
                            class="text-gray-100"
                        >
                            Users
                        </NavLink>
                        <NavLink
                            v-if="isAdmin"
                            :href="route('topics.index')"
                            :active="route().current('topics')"
                            class="text-gray-100"
                        >
                            Topics
                        </NavLink>
                        <NavLink
                            v-if="isAdmin"
                            :href="route('discussions.index')"
                            :active="route().current('discussions')"
                            class="text-gray-100"
                        >
                            Discussions
                        </NavLink>
                        <NavLink
                            v-if="isAdmin"
                            :href="route('posts.index')"
                            :active="route().current('posts')"
                            class="text-gray-100"
                        >
                            Posts
                        </NavLink>
                    </div>
                </div>

                <div class="hidden md:flex md:items-center md:ms-6">
                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative" v-if="$page.props.auth.user">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-500 hover:text-white focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>

                    <div v-else class="hidden space-x-8 md:-my-px md:ml-10 md:flex h-16">
                        <NavLink :href="route('login')" :active="route().current('login')">
                            Login
                        </NavLink>
                        <NavLink :href="route('register')" :active="route().current('register')">
                            Register
                        </NavLink>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center md:hidden">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
            :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
            class="md:hidden"
        >
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('home')" :active="route().current('home')">
                    Forum
                </ResponsiveNavLink>
                <!-- Visible to Admins Only -->
                <ResponsiveNavLink
                    v-if="isAdmin"
                    :href="route('summary')"
                    :active="route().current('summary')"
                >
                    Summary
                </ResponsiveNavLink>
                <ResponsiveNavLink
                    v-if="isAdmin"
                    :href="route('users.index')"
                    :active="route().current('users')"
                >
                    Users
                </ResponsiveNavLink>
                <ResponsiveNavLink
                    v-if="isAdmin"
                    :href="route('topics.index')"
                    :active="route().current('topics')"
                >
                    Topics
                </ResponsiveNavLink>
                <ResponsiveNavLink
                    v-if="isAdmin"
                    :href="route('discussions.index')"
                    :active="route().current('discussions')"
                >
                    Discussions
                </ResponsiveNavLink>
                <ResponsiveNavLink
                    v-if="isAdmin"
                    :href="route('posts.index')"
                    :active="route().current('posts')"
                >
                    Posts
                </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.auth.user">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">
                        {{ $page.props.auth.user.name }}
                    </div>
                    <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                        Log Out
                    </ResponsiveNavLink>
                </div>
            </div>
        </div>
    </nav>
</template>
