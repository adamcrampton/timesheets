<template>
    <div class="row">
        <div class="col">
            <button class="btn btn-block btn-primary">{{ workTimer ? 'Stop' : 'Start' }} Work Timer</button>
        </div>
        <div class="col">
            <button class="btn btn-block btn-warning">{{ breakTimer ? 'Stop' : 'Start' }} Break Timer</button>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
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

        },
        // Request backend to update entry with end time.
        stop() {

        }
    }
}
</script>
