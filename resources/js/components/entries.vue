<template>
    <div>
        <div class="alert alert-warning text-center" v-show="entries.length === 0">No entries found</div>
        <table class="table table-striped table-bordered table-hover" v-show="entries.length > 0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                <tr 
                    v-for="entry in entries" 
                    :key="entry.id" 
                    :value="entry.id"
                >
                    <td>{{ entry.id }}</td>
                    <td>{{ entry.type.name }}</td>
                    <td>{{ entry.start_time }}</td>
                    <td>{{ entry.start_date }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import Axios from 'axios';
import EventBus from '../event-bus.js';

export default {
    data() {
        return {
            entries: []
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
        
        // Push new entry into array.
        EventBus.$on('addEntry', (entry) => {
            this.entries.push(entry);
        });
    }
}
</script>