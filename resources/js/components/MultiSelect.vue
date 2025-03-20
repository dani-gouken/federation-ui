<template>
    <div>
        <Multiselect :required="required" :multiple="multiple" :close-on-select="true" label="name" track-by="value"
            :disabled="disabled" :id="id" v-model="value" :options="options" :placeholder="placeholder">
        </Multiselect>
        <template v-for="item in value" v-if="multipleValueSelected">
            <input type="hidden" :name="name" :value="item.value" />
        </template>
        <template v-else>
            <input type="hidden" :name="name" :value="value?.value" />
        </template>
    </div>
</template>
<script setup>
import { ref, defineProps, watch, computed, onMounted } from 'vue'
import Multiselect from 'vue-multiselect'
const props = defineProps({
    name: {
        type: String,
        required: true
    },
    class: {
        type: String,
        required: false
    },
    options: {
        type: String,
        required: true
    },
    selected: String,
    id: String,
    disabled: {
        type: Boolean,
        default: false,
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    required: {
        type: Boolean,
        default: false,
    },
    placeholder: String
})

const value = ref(null)
const options = ref(JSON.parse(props.options))
const selected = JSON.parse(props.selected)
const multipleValueSelected = computed(() => Array.isArray(value.value))
onMounted(() => {
    value.value = options.value.filter((v) => Array.isArray(selected) ? selected.includes(v.value) : v.value == selected)
})
</script>