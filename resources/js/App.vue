<template>
    <div>
        <Navbar>
        </Navbar>

        <router-view></router-view>
    </div>
</template>

<script>

import Navbar from '../js/pages/Navbar.vue';
export default{
    name:'app',
    components:{
        Navbar
    }
}

</script>

