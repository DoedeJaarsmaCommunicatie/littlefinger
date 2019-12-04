<template>
    <form role="search" class="homepage-filter" @submit.prevent="fireForm" >
        <h3 :data-title="title" :title="title" class="homepage-filter_title">{{ title }}</h3>
        
        <div class="custom-input">
            <span class="selected" @click="toggleList" v-if="activeCategory">
                {{ activeCategory.title }} <i class="fas fa-chevron-down" />
            </span>
            
            <ul class="options" ref="categoriesList" role="listbox">
                <li
                    v-for="(item, key) in categories"
                    :key="key"
                    :data-key="key"
                    class="option"
                    data-param="product-categorie"
                    :data-value="item.slug"
                    @click.exact.prevent="setActiveCategory(key)"
                    :class="{ current: activeCategory.slug === item.slug }"
                    role="option"
                >
                    {{ item.title }}
                </li>
            </ul>
        </div>
        
        <div class="custom-input">
            <span class="selected" @click="toggleList" v-if="activePrice">
                Voor {{ activePrice.title }} <i class="fas fa-chevron-down"></i>
            </span>
            <ul class="options" ref="pricesList">
                <li
                        v-for="(item, key) in prices"
                        :key="key"
                        :data-key="key"
                        class="option"
                        data-param="product-price"
                        :data-value="item.slug"
                        @click.exact.prevent="setActivePrice(key)"
                        :class="{ current: activePrice.slug === item.slug }"
                >
                    {{ item.title }}
                </li>
            </ul>
        </div>
        
        <button
                type="submit"
                role="button"
                class="homepage-filter_button"
        >
            {{ buttonText }}
        </button>
    </form>
</template>

<script lang="ts">
    import { Vue, Component, Prop } from 'vue-property-decorator';
    import * as _ from 'lodash';
    import env from '../config/env';
    
    @Component
    export default class HomepageFilter extends Vue {
        @Prop({default: 'Ik ben op zoek naar:'})
        title: string = 'Ik ben op zoek naar:';

        @Prop({default: 'Toon resultaat', type: String})
        buttonText: string = 'Toon resultaat';
        
        @Prop({default: 'https://italiaansewijnwinkel.nl', type: String})
        baseUrl?: string;

        categories: Array<Category> = env.categories;

        prices: Array<Price> = env.prices;

        // @ts-ignore
        activeCategory: Category = false;
        
        // @ts-ignore
        activePrice: Price = false;

        setActiveCategory(key: number): void {
            let category = this.categories[key];
            if (this.activeCategory.slug !== category.slug) {
                this.categories[_.findIndex(this.categories, c => c.active === true)].active = false;
                category.active = true;
                this.activateCategory();
            }
            this.closeAllLists();
        }

        setActivePrice(key: number): void {
            let price = this.prices[key];
            if (this.activePrice.slug !== price.slug) {
                this.prices[_.findIndex(this.prices, p => p.active === true)].active = false;
                price.active = true;
                this.activatePrice();
            }
            
            this.closeAllLists();
        }

        closeAllLists(): void {
            (<HTMLElement>this.$refs['categoriesList']).classList.remove('active');
            (<HTMLElement>this.$refs['pricesList']).classList.remove('active');
        }
        
        toggleList(ev: any): void { // noinspection JSMethodCanBeStatic
            let parent = ev.target.parentElement as HTMLElement;
            let target = parent.querySelector('.options');

            if (!target || !parent) {
                return;
            }
            
            ev.target.classList.toggle('active');
            target.classList.toggle('active');
        }
        
        fireForm() {
            let price = null;
            let category = null;
            
            if (this.activeCategory.slug !== '*') {
                category = this.activeCategory.slug
            }
            
            if (this.activePrice.slug !== '*') {
                price = this.activePrice.slug;
            }
            
            if (category) {
                window.location.href = `${this.baseUrl}/winkel/${category}/${price? '?price=' + price : ''}`;
            } else {
                window.location.href = `${this.baseUrl}/winkel/${price? '?price=' + price : ''}`;
            }
        }
        
        mounted () {
            this.activateCategory();
            this.activatePrice();
        }
        
        activateCategory() {
            this.activeCategory = this.categories[_.findIndex(this.categories, c => c.active === true)];
        }
        
        activatePrice() {
            this.activePrice = this.prices[_.findIndex(this.prices, p => p.active === true)];
        }
    }

    export interface Category {
        slug: string;
        title: string;
        active: boolean;
    }
    export interface Price {
        slug: string;
        title: string;
        active: boolean;
    }
</script>

<style scoped lang="scss">
    @import '../../styles/abstracts/all';
    
    .homepage-filter {
        background: $primary;
        padding: 15px 10px;
        text-align: center;
        
        & .homepage-filter_title {
            color: $white;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        & .homepage-filter_button {
            color: $black;
            background: $white;
            width: 100%;
            padding: 10px 0;
            cursor: pointer;
            transition: all 325ms cubic-bezier(0.2, 0.4, 0.0, 0.8);
            
            &:hover {
                background: $black;
                color: $white;
            }
        }
        
        & .custom-input {
            width: 100%;
            background: mix($primary, $white, 90%);
            color: $white;
            position: relative;
            text-align: center;
            cursor: pointer;
            margin-bottom: 15px;
            transition: all 225ms cubic-bezier(0.2, 0.4, 0.0, 0.8);
            
            &:hover {
                background: mix($primary, $white, 85%);
            }
            
            
            & .selected {
                display: block;
                padding: 10px 0;
            }
            
            .options {
                position: absolute;
                width: 100%;
                opacity: 0;
                padding: 15px 10px;
                transition: all 225ms cubic-bezier(0.2, 0.4, 0.0, 0.8);
                transform: scale(1, 0);
                transform-origin: center top;
                top: calc(100% + 10px);
                left: 0;
                z-index: 10;
                @include shadow;
                
                &.active {
                    opacity: 1;
                    background: mix($primary, $white, 85%);
                    transform: scale(1, 1);
                    transform-origin: center top;
                    
                }
                
                & .option {
                    margin: 5px 0;
                    border-bottom: 1px solid adjust-color($primary, $alpha: -.1);
                    
                    &.current {
                        color: $grey;
                    }
                }
            }
        }
    }
</style>
