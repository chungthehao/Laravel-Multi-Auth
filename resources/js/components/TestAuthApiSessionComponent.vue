<template>
    <div></div>
</template>

<script>
    export default {
        created() {
            axios.post('/api/test-auth-use-session')
                .then(res => console.log(res.data))
                .catch(err => console.log(err.response.data));
        }
    }
</script>
