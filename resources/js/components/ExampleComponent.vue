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
                    <td class="text-left">{{ item.crew_code }}</td>
                    <td class="text-left">{{ item.name }}</td>
                    <td class="text-left">{{ item.ship }}</td>
                    <td class="text-left">{{ item.employeer_details.phone_number }}</td>
                    <td class="text-left">{{ item.employeer_details.rank }}</td>
                    <td class="text-left" >{{ item.format }}</td>
                    <td class="text-left">
                        <a :href="'detail/'+item.id" class="btn btn-success">Detail</a>
                    </td>
                </tr>
            </tbody>
        </data-table>
    </div>
</template>

<script>
    import moment from 'moment'
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
                        label: 'Crew Code',
                        name: 'crew_code',
                        orderable: true,
                    },
                    {
                        label: 'Name',
                        name: 'name',
                        orderable: true,
                    },
                    {
                        label: 'Ship Name',
                        name: 'ship',
                        orderable: true,
                    },
                    {
                        label: 'Phone',
                        name: 'employeer_details.phone_number',
                        orderable: true,
                    },
                    {
                        label: 'Rank',
                        name: 'employeer_details.rank',
                        orderable: true,
                    },
                    {
                        label: 'Deperature Date',
                        name: 'employeer_details.deperature_date',
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
        watch: {
            'users.data': {
                handler (newValue, oldValue) {
                    newValue.forEach((item) => {
                      console.log(item);
                      item.format = moment(item.employeer_details.deperature_date).format('DD-MM-YYYY');
                  })
                },
                deep: true
            }
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
