<template>
    <div class="container" style="padding-top: 30px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="card-title">D III PBB / Penilai</h5>
                        </div>
                        <div class="col-md-3">
                            <a href="/download_data/4/D-III_PBBpenilai"><button class="btn btn-outline-primary btn-sm" style="float:right">
                                Export to Excel</button>
                            </a>
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                        <app-datatable
                            :items="items"
                            :fields="fields"
                            :meta="meta"
                            :editUrl="'/a/b'"
                            :title="'Delete'"
                            @per_page="handlePerPage"
                            @pagination="handlePagination"
                            @search="handleSearch"
                            @sort="handleSort"
                            @delete="handleDelete"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datatable from './Datatable.vue'
import axios from 'axios'

export default {
    created() {
         this.loadPostsData(4)
    },
    data() {
        return {
            fields: [
                {key: 'id', sortable: true},
                {key: 'nama', sortable: true},
                {key: 'email', sortable: true},
                {key: 'jenisKelamin', sortable: false},
                {key: 'npm', sortable: true},
                {key: 'kelas', sortable: true},
                {key: 'absen', sortable: false},
                {key: 'sizeToga', sortable: false},
                {key: 'alamat', sortable: false},
                {key: 'provinsi', sortable: true},
                {key: 'kota', sortable: true},
                {key: 'kecamatan', sortable: true},
                {key: 'kelurahan', sortable: true},
                {key: 'kodepos', sortable: false},
                {key: 'nomorWhatsapp', sortable: false},
                {key: 'namaAyah', sortable: false},
                {key: 'namaIbu', sortable: false},
                {key: 'photo', sortable: false}//,
                //{key: 'actions', sortable: false}
            ],
            items: [],
            meta: [],
            current_page: 1,
            per_page: 10,
            search: '',
            sortBy: 'mahasiswas.id',
            sortByDesc: false
        }
    },
    components: {
        'app-datatable': Datatable
    },
    methods: {

        loadPostsData($prodi_id) {
            let current_page = this.search == '' ? this.current_page:1

            axios.get('/datas/'+ $prodi_id, {
                params: {
                    page: current_page,
                    per_page: this.per_page,
                    q: this.search,
                    sortby: this.sortBy,
                    sortbydesc: this.sortByDesc ? 'DESC':'ASC'
                }
            })
            .then((response) => {
                let getData = response.data.data
                this.items = getData.data
                this.meta = {
                    total: getData.total,
                    current_page: getData.current_page,
                    per_page: getData.per_page,
                    from: getData.from,
                    to: getData.to
                }
            })
        },
        deletePostData(id) {
            axios.delete(`delete/${id}`).then(() => this.loadPostsData())
        },
        handlePerPage(val) {
            this.per_page = val
             this.loadPostsData(4)
        },
        handlePagination(val) {
            this.current_page = val
             this.loadPostsData(4)
        },
        handleSearch(val) {
            this.search = val
             this.loadPostsData(4)
        },
        handleSort(val) {
            this.sortBy = 'mahasiswas.'.val.sortBy
            this.sortByDesc = 'mahasiswas.'.val.sortDesc

             this.loadPostsData(4)
        },
        handleDelete(val) {
            this.deletePostData(val.id)
        }
    }
}
</script>
