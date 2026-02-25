<template>
    <div>
        <!-- List View -->
        <div v-if="view === 'list'">
            <h1 class="h3 mb-3">Orders / List</h1>

            <div class="row">
                <div class="col-md-6 ml-auto">
                    <v-toolbar
                        style="background-color: hsla(0deg, 0%, 100%, 0.5)"
                        class="px-2 mb-3"
                    >
                        <v-select
                            v-model="selectedStatus"
                            :items="statusOptions"
                            label="Filter by Status"
                            @change="onStatusChange"
                        ></v-select>
                    </v-toolbar>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <easy-data-table
                                class="data-table"
                                :headers="headers"
                                :items="filteredOrders || []"
                                :rows-per-page="15"
                                :loading="busy"
                                alternating
                                @click-row="rowClick"
                            >
                                <template #item-fulfillment_status="item">
                                    <span
                                        class="status-dot"
                                        :class="item.fulfillment_status === 'fulfilled' ? 'dot-green' : 'dot-red'"
                                    ></span>
                                    {{ item.fulfillment_status === 'fulfilled' ? 'Fulfilled' : 'Needs Fulfillment' }}
                                </template>
                                <template #item-customer_name="item">
                                    {{ item.customer_name || 'Not provided' }}
                                </template>
                            </easy-data-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail View -->
        <div v-else-if="view === 'detail'">
            <h1 class="h3 mb-3">Orders / Detail: #{{ selectedOrder.id }}</h1>

            <a href="#" @click.prevent="backToList">&#8592; Back to Orders</a>

            <my-alert :setup="alert" @clear="() => (alert = {})"></my-alert>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Order Info</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless mb-0 order-info-table">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="w-25">Order #</th>
                                        <td>{{ selectedOrder.id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Date</th>
                                        <td>{{ selectedOrder.created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Customer</th>
                                        <td>{{ selectedOrder.customer_name || 'Not provided' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Email</th>
                                        <td>{{ selectedOrder.customer_email || 'Not provided' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Post</th>
                                        <td>{{ selectedOrder.post_title || 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Amount</th>
                                        <td>{{ selectedOrder.amount }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Shipping Address</th>
                                        <td>
                                            <template v-if="selectedOrder.shipping_address && typeof selectedOrder.shipping_address === 'object'">
                                                <div>{{ selectedOrder.shipping_address.line1 }}</div>
                                                <div v-if="selectedOrder.shipping_address.line2">{{ selectedOrder.shipping_address.line2 }}</div>
                                                <div>{{ selectedOrder.shipping_address.city }}, {{ selectedOrder.shipping_address.state }} {{ selectedOrder.shipping_address.postal_code }}</div>
                                                <div>{{ selectedOrder.shipping_address.country }}</div>
                                            </template>
                                            <template v-else>Not provided</template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Fulfillment</h5>
                        </div>
                        <div class="card-body">
                            <v-select
                                v-model="editForm.fulfillment_status"
                                :items="[{title: 'Needs Fulfillment', value: 'unfulfilled'}, {title: 'Fulfilled', value: 'fulfilled'}]"
                                item-title="title"
                                item-value="value"
                                label="Status"
                                class="mb-8"
                            ></v-select>
                            <v-text-field
                                v-model="editForm.tracking_number"
                                label="Tracking Number"
                                class="mb-8"
                            ></v-text-field>
                            <v-textarea
                                v-model="editForm.notes"
                                label="Notes"
                                rows="3"
                            ></v-textarea>
                            <v-btn
                                color="info"
                                class="mt-8"
                                :loading="processing"
                                @click="saveChanges"
                            >
                                Save Changes
                            </v-btn>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EasyDataTable from "vue3-easy-data-table";

    export default {
        components: {
            EasyDataTable,
        },

        data() {
            return {
                orders: [],
                busy: true,
                view: 'list',
                selectedOrder: null,
                selectedStatus: 'All',
                statusOptions: ['All', 'Needs Fulfillment', 'Fulfilled'],
                editForm: {
                    fulfillment_status: '',
                    tracking_number: '',
                    notes: '',
                },
                processing: false,
                alert: {},
                headers: [
                    { text: '#', value: 'id', sortable: true },
                    { text: 'Customer', value: 'customer_name', sortable: true },
                    { text: 'Post', value: 'post_title', sortable: true },
                    { text: 'Amount', value: 'amount', sortable: true },
                    { text: 'Status', value: 'fulfillment_status', sortable: true },
                    { text: 'Date', value: 'created_at', sortable: true },
                ],
            };
        },

        computed: {
            filteredOrders() {
                if (this.selectedStatus === 'All') {
                    return this.orders;
                } else if (this.selectedStatus === 'Needs Fulfillment') {
                    return this.orders.filter(o => o.fulfillment_status === 'unfulfilled');
                } else if (this.selectedStatus === 'Fulfilled') {
                    return this.orders.filter(o => o.fulfillment_status === 'fulfilled');
                }
                return this.orders;
            },
        },

        created() {
            this.fetchOrders();
        },

        methods: {
            fetchOrders() {
                axios.get('/api/admin/orders')
                    .then(response => {
                        this.orders = response.data.data;
                        this.busy = false;
                    })
                    .catch(() => {
                        this.busy = false;
                    });
            },

            onStatusChange() {
                // filtering handled by filteredOrders computed property
            },

            rowClick(record) {
                this.selectedOrder = record;
                this.editForm.fulfillment_status = record.fulfillment_status;
                this.editForm.tracking_number = record.tracking_number || '';
                this.editForm.notes = record.notes || '';
                this.view = 'detail';
                this.alert = {};
            },

            backToList() {
                this.view = 'list';
                this.selectedOrder = null;
                this.alert = {};
            },

            saveChanges() {
                this.processing = true;
                this.alert = {};
                axios.patch(`/api/admin/orders/${this.selectedOrder.id}`, {
                    fulfillment_status: this.editForm.fulfillment_status,
                    tracking_number: this.editForm.tracking_number,
                    notes: this.editForm.notes,
                })
                    .then(response => {
                        this.processing = false;
                        Object.assign(this.selectedOrder, response.data.data);
                        this.alert = { message: 'Order updated successfully' };
                    })
                    .catch(error => {
                        this.processing = false;
                        this.alert = {
                            title: 'Error',
                            ...error.response?.data,
                            errors: true,
                        };
                    });
            },
        },
    };
</script>

<style scoped>
.status-dot {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 6px;
    vertical-align: middle;
}
.dot-green { background-color: #28a745; }
.dot-red { background-color: #dc3545; }
.order-info-table th,
.order-info-table td {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    cursor: default;
}
</style>
