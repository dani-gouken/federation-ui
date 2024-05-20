<template>
    <Multiselect :required="required" :multiple="multiple" :close-on-select="true" label="name" track-by="value"
        :disabled="disabled" :id="id" v-model="value" :options="options" :placeholder="placeholder">
    </Multiselect>
    <template v-for="item in value" v-if="multipleValueSelected">
        <input type="hidden" :name="name" :value="item.value" />
    </template>
    <template v-else>
        <input type="hidden" :name="name" :value="value?.value" />
    </template>
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
        type: Array,
        required: true
    },
    selected: {},
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
const options = ref(props.options)
const multipleValueSelected = computed(() => Array.isArray(value.value))
onMounted(() => {
    value.value = props.options.filter((v) => Array.isArray(props.selected) ? props.selected.includes(v.value) : v.value == props.selected)
})
</script>