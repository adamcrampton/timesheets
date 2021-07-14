<template>
    <div class="row">
        <div class="col">
            <button class="btn btn-block btn-primary" @click="workTimer ? stop('work') : start('work')">{{ workTimer ? 'Stop' : 'Start' }} Work Timer</button>
        </div>
        <div class="col">
            <button class="btn btn-block btn-warning" @click="breakTimer ? stop('break') : start('break')">{{ breakTimer ? 'Stop' : 'Start' }} Break Timer</button>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
import EventBus from '../event-bus.js';

export default {
    data() {
        return {
            entries: [],
            currentEntry: null,
            workTimer: false,
            breakTimer: false
        }
    },
    methods: {
        // Save new row + set current entry ID.
        save(type) {
            Axios.post('/entries/store', {
                type: type
            })
            .then((response) => {
                // Save new entry + push into entries lists.
                this.currentEntry = response.data.id;
                this.entries.push(response.data);
                EventBus.$emit('addEntry', response.data);
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {});
        },
        // Request backend to insert start entry and return.
        start(type) {
            // Set properties.
            this.workTimer = type === 'work';
            this.breakTimer = type === 'break';

            // Save new entry.
            this.save(type);
        },
        // Request backend to update entry with end time.
        stop() {
            if (this.workTimer) {
                this.workTimer = false;
            } else {
                this.breakTimer = false;
            }

            this.update();
        },
        // Update current row.
        update() {
            Axios.put('/entries/' + this.currentEntry + '/update')
            .then((response) => {
                // Update end time in table.
                EventBus.$emit('stopEntry', {
                    id: this.currentEntry, 
                    end: response.data.end, 
                    duration: response.data.duration
                });
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {});
        }
    }
}
</script>
