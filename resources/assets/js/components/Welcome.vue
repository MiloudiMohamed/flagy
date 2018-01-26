<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Start Playing</div>

                <div class="panel-body">
                    <router-link class="btn btn-danger btn-block" :to="{ name: 'difficulty' }">
                        Play as a guest
                    </router-link>
                   <div class="text-center btn-block btn">
                        <a href="/register">Register</a> or <a href="/login">Login</a>
                   </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
