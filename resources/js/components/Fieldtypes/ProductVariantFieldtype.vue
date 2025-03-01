<template>
    <div class="bg-white">
        <div v-if="initializing" class="flex flex-col items-center justify-center text-center p-1">
            <loading-graphic />
        </div>

        <div v-else>
            <p
                v-if="value == null"
                class="text-sm p-1"
            >Product doesn't support variants.</p>

            <p
                v-else-if="productVariantsData == null"
                class="text-sm p-1"
            >No product selected.</p>

            <select-field
                v-if="productVariantsData && productVariantsData.purchasable_type === 'variants'"
                :options="productVariantOptions"
                :disabled="readOnly"
                v-model="variant.variant"
            ></select-field>

            <p
                v-else-if="productVariantsData && productVariantsData.purchasable_type === 'product'"
                class="text-sm p-1"
            >Product doesn't support variants.</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import SelectField from '../../../../vendor/statamic/cms/resources/js/components/inputs/Select'

export default {
    name: 'product-variant-fieldtype',

    components: {
        SelectField
    },

    mixins: [Fieldtype],

    props: ['meta'],

    data() {
        return {
            initializing: true,
            variant: this.value,

            productVariantsData: null,
        }
    },

    computed: {
        product() {
            return Statamic.$store.state.publish.base.values.items[this.namePrefix.match(/\[(.*)\]/).pop()].product[0]
        },

        productVariantOptions() {
            return this.productVariantsData.variants.map((variant) => {
                return {
                    label: variant.variant,
                    value: variant.key
                }
            })
        },
    },

    methods: {
        getProductVariants() {
            if (! this.product) {
                this.initializing = false
                return;
            }

            axios.post(this.meta.api, { product: this.product })
                .then((response) => {
                    this.productVariantsData = response.data
                    this.initializing = false
                })
                .catch((error) => {
                    console.error('There was an error fetching variants for this product.')
                })
        },
    },

    mounted() {
        if (this.value == null) {
            this.initializing = false
        }

        if (! this.variant.product) {
            this.variant.product = this.product
        }

        this.getProductVariants()
    },

    watch: {
        product() {
            this.variant = {
                variant: null,
                product: this.product
            }

            this.productVariantsData = null
            this.getProductVariants()
        }
    }
}
</script>
