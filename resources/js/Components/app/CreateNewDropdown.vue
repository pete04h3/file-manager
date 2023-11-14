<script setup>
  import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
  import CreateFolderModal from './CreateFolderModal.vue';
  import {ref} from "vue";

  const createFolderModal = ref(false);

  function showCreateFolderModal()
  {
    createFolderModal.value = true;
  }
  
//   import ArchiveIcon from './archive-icon.vue'
//   import DuplicateIcon from './duplicate-icon.vue'
//   import MoveIcon from './move-icon.vue'
//   import EditIcon from './edit-icon.vue'
//   import DeleteIcon from './delete-icon.vue'
  </script>
  


<template>
      <Menu as="div" class="relative inline-block text-left w-full">
    
          <MenuButton
            class="inline-flex w-full justify-center rounded-md bg-indigo-700 px-2 py-2 text-sm font-medium text-white focus:outline-none focus-visible:ring-2"
          >
         Create New
          
          </MenuButton>
     
  
        <transition
          enter-active-class="transition duration-100 ease-out"
          enter-from-class="transform scale-95 opacity-0"
          enter-to-class="transform scale-100 opacity-100"
          leave-active-class="transition duration-75 ease-in"
          leave-from-class="transform scale-100 opacity-100"
          leave-to-class="transform scale-95 opacity-0"
        >
          <MenuItems
            class="absolute left-0 mt-2 origin-top-right divide-y divide-gray-300 rounded-md bg-indigo-700 text-white ring-white/100 shadow-lg ring-1 focus:outline-none"
          >
            <div class="px-1 py-1">
              <MenuItem v-slot="{ active }" class="text-white w-full">
                <a 
                href="#" 
                @click.prevent="showCreateFolderModal" 
                class="text-gray-700 block px-4 py-2 text-sm">
                    New folder
                </a>
        
              </MenuItem>
            </div>

            <div class="px-1 py-1">
              <MenuItem v-slot="{ active }" class="text-white  w-full">
            <a href="" class="text-gray-700 block px-4 py-2 text-sm">
                Upload Folder
            </a>
              </MenuItem>
              <MenuItem v-slot="{ active }" class="text-white  w-full">
                <a href="" class="text-gray-700 block px-4 py-2 text-sm">
                    Upload Files
                </a>
              </MenuItem>
            </div>
          
          
          </MenuItems>
        </transition>
      </Menu>

      <CreateFolderModal v-model="createFolderModal" />
</template>