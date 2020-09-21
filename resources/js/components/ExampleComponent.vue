<template>
    <div class="container">
        <data-table
            :columns="columns"
            :data = "users"
            :per-page="perPage"
        >
            <div slot="filters" slot-scope="{ perPage }">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select class="form-control" v-model="tableProps.length" @change="reloadTable">
                            <option :key="page" v-for="page in perPage">{{ page }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 offset-md-4">
                        <input
                            @keyup="reloadTable"
                            name="name"
                            class="form-control"
                            v-model="tableProps.search"
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
                url: '/api/get-all-user',
                user_token: "eyJpdiI6IjlaSHRCM1d4V0ZDd3RoNXpNUnF4MUE9PSIsInZhbHVlIjoiUkRoQm1BdTV6ZFoxcEdkaTlqcU5uOUlrZDRKdDUza0RGVHoybXNjUDlXanVIV2NsdFVpenVWSmpaWDBIdGc0a09uc2k0Qzl4cEhWbUl3UjJaTmcyOTc2UTRWSmp0RVoxdTR5YXdCelwvNmRWbUM3Z0p4T25oRzVyUnFoWmRueFRLIiwibWFjIjoiN2VhZDdkYjYzMzk1YzU2NjVmZDM1ZDQ1NjM0MzA0YmE4ZmNlOWM3MTNkNWZhZDI5ZDgxOWQyNDM4YzJlYzQ5MSJ9",
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
            this.getData(this.url);
        },
        methods: {
            getData(url = this.url, options = this.tableProps) {
                axios.post(url, {
                    ...options
                }, {
                    headers:{'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    this.users = result.data;
                });
            },

            reloadTable(){
                this.getData(this.url);
            },
        }
    }
</script>
