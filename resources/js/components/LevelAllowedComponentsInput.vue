<template>
    <div class="form-group mt-3">
        <label for="allowed_components">Допустимые логические компоненты</label>
        <tags-input
            wrapper-class="form-control"
            placeholder=""
            v-model="allowedComponents"
            v-bind:existing-tags="existingTags"
            :typeahead="true"
            :typeahead-always-show="true"
            :only-existing-tags="true"
            :typeahead-hide-discard="true"
            element-id="allowed_components"
        ></tags-input>
    </div>
</template>

<script>
export default {
    props: {
        existingTags: Array,
        allowedComponentsValue: Array
    },
    data() {
        return {
            allowedComponents: []
        }
    },
    beforeMount() {
        this.allowedComponents = this.allowedComponentsValue;
    }
}
</script>

