<template>
    <div>
        <el-menu @select="handleSelect"
                 :collapse="collapsed"
                 :default-active="active"
                 class="el-menu-vertical-size">
            <el-menu-item index="offers" @click="handleUrl">
                <i class="el-icon-view"></i>
                <span slot="title">Zarządzanie ofertami</span>
            </el-menu-item>
            <el-menu-item index="markets" @click="handleUrl">
                <i class="el-icon-information"></i>
                <span slot="title">Obserwowane giełdy</span>
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
                active: '',
                collapsed: true,
                url:{
                     logout: {path:'/dashboard/logout'},
                     offers: {path: '/dashboard/offers-manager'},
                     markets: {path: '/dashboard/markets-manager'}
                }
            }
        },
        created() {
            (window.innerWidth < 992)? this.collapsed = true : this.collapsed = false;
             window.addEventListener('resize', this.isCollapse);
             this.setActiveIndex();
        },
        methods:{
            setActiveIndex() {
                let path = location.pathname;
                let urls = this.url;
                let active = '';

                for (let item in urls) {
                    if(path === urls[item].path) {
                        active = item
                    }
                }
                this.active = active;
            },
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
            handleUrl(data) {
                window.location = this.url[data.index].path;
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