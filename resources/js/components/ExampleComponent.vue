<template>
    <div class="container">
        <data-table
            :columns="columns"
            :data = "users"
            :per-page="perPage"
            @onTablePropsChanged="reloadTable"
        >
            <div slot="filters" slot-scope="{tableData, perPage }">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select class="form-control" v-model="tableData.length">
                            <option :key="page" v-for="page in perPage">{{ page }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 offset-md-4">
                        <input
                            name="name"
                            class="form-control"
                            v-model="tableData.search"
                            placeholder="Search Email or Name">
                    </div>
                </div>
            </div>
            <tbody slot="body" slot-scope="{ data }">
                <tr
                    :key="item.id"
                    v-for="item in data">
                    <td class="text-left">{{ item.id }}</td>
                    <td class="text-left">{{ item.name }}</td>
                    <td class="text-left">{{ item.email }}</td>
                    <td class="text-left">
                        <button :class="'btn btn-xs btn-primary'" @click="EditItem(item)" title="Edit">
                                <span>
                                    <i class="mdi mdi-grease-pencil" aria-hidden="true"></i>
                                </span>
                            &nbsp;
                            Edit
                        </button>
                        <button :class="'btn btn-xs btn-danger'" @click="onDeleteItem(item)" title="Delete">
                                <span>
                                    <i class="mdi mdi-delete" aria-hidden="true"></i>
                                </span>
                            &nbsp;
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </data-table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user_token: `${process.env.MIX_APP_TOKEN}`,
                perPage: [10, 25, 100, 300],
                users: {},
                default_order_column:'id',
                default_order_dir:'desc',
                tableProps: {
                    search: '',
                    length: 10,
                    column: 'id',
                    dir: 'desc',
                },
                columns: [
                    {
                        label: 'ID',
                        name: 'id',
                        orderable: true,
                    },
                    {
                        label: 'Name',
                        name: 'name',
                        orderable: true,
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        orderable: true,
                    },
                    {
                        label: 'Action'
                    }
                ]
            }
        },
        created() {
            this.getData();
        },
        methods: {
            getData() {
                axios.post('/api/get-all-user', {
                    ...this.tableProps
                }, {
                    headers:{'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    this.users = result.data;
                });
            },

            reloadTable(tableProps){
                this.tableProps = tableProps;
                this.getData(tableProps);
            },
        }
    }
</script>
