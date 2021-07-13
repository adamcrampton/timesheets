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

export default {
    data() {
        return {
            entries: [],
            currentEntry: null,
            currentWorkStart: null,
            currentBreakStart: null,
            workTimer: false,
            breakTimer: false
        }
    },
    methods: {
        // Request backend to insert start entry and return.
        start(type) {
            this.workTimer = type === 'work';
            this.breakTimer = type === 'break';
        },
        // Request backend to update entry with end time.
        stop(type) {
            this.workTimer = type === 'break';
            this.breakTimer = type === 'work';
        }
    }
}
</script>
