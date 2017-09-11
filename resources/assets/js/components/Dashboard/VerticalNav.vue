<template>
    <div>
        <el-menu @select="handleSelect"
                 :collapse="collapsed"
                 :default-active="active"
                 class="el-menu-vertical-size">
            <el-menu-item index="dashboard">
                <i class="el-icon-view"></i>
                <a :href="this.url.dashboard.path">Zarządzanie ofertami</a>
            </el-menu-item>
            <el-menu-item index="places">
                <i class="el-icon-information"></i>
                <a :href="this.url.places.path">Obserwowane giełdy</a>
            </el-menu-item>
            <el-menu-item index="logout" @click="confirmLogout">
                <i class="el-icon-close"></i>
                <span slot="title">Logout</span>
            </el-menu-item>
        </el-menu>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                active: 'dashboard',
                collapsed: true,
                url:{logout: {path:'/dashboard/logout'},
                     dashboard: {path: '/dashboard'},
                     places: {path: 'dashboard/places'}}
            }
        },
        created() {
            (window.innerWidth < 992)? this.collapsed = true : this.collapsed = false;
             window.addEventListener('resize', this.isCollapse);
        },

        methods:{
            isCollapse(event) {
                return (event.currentTarget.innerWidth < 992)? this.collapsed = true : this.collapsed = false;
            },
            confirmLogout() {
                this.$confirm(`Czy napewno chcesz sie wylogować`, 'Uwaga!' , {
                    confirmButtonText: 'Tak',
                    confirmButtonClass: 'el-button--primary',
                    cancelButtonText: 'Anuluj',
                }).then(() => {
                    this.logout();
                }).catch(() => {
                    this.active = '';
                });
            },
            logout() {
                axios.post(this.url.logout.path).then(() => {
                    window.location = window.location.origin;
                }).catch(response => {
                    console.log(response.error);
                });
            },
            handleSelect(index) {
                this.active = index;
            }
        }
    }
</script>

<style>
    .el-menu-vertical-size:not(.el-menu--collapse) {
        width: 195px;
    }
</style>