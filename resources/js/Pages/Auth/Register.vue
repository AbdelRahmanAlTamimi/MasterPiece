<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
const emailError = ref('');
const showEmailHelper = ref(false);

const form = useForm({
    username: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

// Email validation function
const validateEmail = (email) => {
    if (!email) {
        emailError.value = 'Email is required';
        return false;
    }
    if (!emailPattern.test(email)) {
        emailError.value = 'Please enter a valid email address (e.g., username@email.com)';
        return false;
    }
    emailError.value = '';
    return true;
};

// Watch for email changes
watch(() => form.email, (newValue) => {
    validateEmail(newValue);
});

const submit = () => {
    // Validate email before submission
    if (!validateEmail(form.email)) {
        return;
    }

    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="username" value="Username" />

                <TextInput
                    id="username"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.username"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <div class="mt-4">
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}"
                    @input="validateEmail(form.email)"
                    @focus="showEmailHelper = true"
                    @blur="showEmailHelper = false"
                    :class="{ 'border-red-500': emailError }"
                />
                <div class="mt-1 text-sm">
                    <p class="text-gray-500" v-if="showEmailHelper">
                        Email must:
                        <ul class="list-disc ml-5">
                            <li>Contain a username (letters, numbers, dots, underscores, or hyphens)</li>
                            <li>Include @ symbol</li>
                            <li>Have a valid domain (e.g., gmail.com, yahoo.com)</li>
                        </ul>
                    </p>
                    <!-- Error Message -->
                    <p v-if="emailError" class="text-red-500 mt-1">
                        {{ emailError }}
                    </p>
                </div>

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<style scoped>
.border-red-500 {
    border-color: rgb(239, 68, 68);
}
.text-sm {
    transition: all 0.3s ease;
}
</style>[
