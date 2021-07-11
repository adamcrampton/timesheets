<template>
    
</template>

<script>
import Axios from 'axios';

export default {
    data() {
        return {
            entries: null
        }
    },
    mounted() {
        // Fetch all entries for current data for user.
        Axios.get('/entries/current')
            .then((response) => {
                this.entries = response.data;
            })
            .catch((error) => {
                console.log(error)
            })
            .finally(() => {

            });
    }
}
</script>