<script setup>
import Modal from "@/Components/Modal.vue";
import TextInput from "../TextInput.vue";
import InputError from "../InputError.vue";
import InputLabel from "../InputLabel.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import SecondaryButton from "../SecondaryButton.vue";
import PrimaryButton from "../PrimaryButton.vue";
import {nextTick, ref} from "vue";
import {showSuccessNotification} from "@/event-bus.js";


const {modelValue} = defineProps({
    modelValue: Boolean
})

const form = useForm({
    name: '',
    parent_id: null
})

const page = usePage();

const folderNameInput = ref(null);

const emit = defineEmits(['update:modelValue']);


function onShow() {
    nextTick(() => folderNameInput.value.focus())
}


function createFolder() 
{
    // console.log("Create folder");
    form.parent_id = page.props.folder.id;
    form.post(route('folder.create'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
            form.reset();
            // Show success notification
            showSuccessNotification(`The folder "${name}" was created`)
        },
        onError: () => folderNameInput.value.focus()
    });
}

function closeModal()
{
    // console.log("Close modal");
    emit('update:modelValue');
    form.clearErrors();
    form.reset();
}

</script>


<template>
    <modal :show="modelValue" @show="onShow">
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Create New Folder
        </h2>


        <div class="mt-6">
            <InputLabel for="folderName" value="Folder name" />
            <TextInput 
            type="text"
            ref="folderNameInput" 
            id="folderName"
            v-model="form.name"
            class="mt-1 block w-full"
            :class="form.errors.name ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''"
            placeholder="Folder Name"
            @keyup.enter="createFolder" 
            
            />

            <InputError :message="form.errors.name" class="mt-2" />


        </div>

        <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeModal">
                Cancel
            </SecondaryButton>
            <PrimaryButton 
            class="ml-3" 
            :class="{ 'opacity-25': form.processing }" 
            @click="createFolder" 
            :disable="form.processing"> 
                Create
            </PrimaryButton>


        </div>

    </div>
    </modal>
</template>