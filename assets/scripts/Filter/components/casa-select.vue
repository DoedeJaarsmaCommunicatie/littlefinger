<template>
    <div class="custom-input">
        <span class="selected">
            <slot name="selected" /> <i class="fas fa-chevron-down" />
        </span>
        
        <ul class="options" ref="list" role="listbox">
            <li
                v-for="(item, key) in items"
                :key="key"
                :data-key="key"
                class="option"
                :data-value="item.slug"
                @click.exact.prevent="itemSelected(key)"
                v-html="item.title"
                role="option"
            />
        </ul>
    </div>
</template>

<script lang="ts">
    import { Vue, Component, Prop } from 'vue-property-decorator';
    
    @Component
    export default class CasaSelect extends Vue {
        @Prop({type: Array, default: []})
        items: any[] = [];
        
        created() {
            console.dir(this.items);
        }
        
        itemSelected(key: number) {}
    }
</script>

<style scoped>

</style>
