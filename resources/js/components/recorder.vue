<template>
    <div class="row">
        <div class="col">
            <button class="btn btn-block btn-primary">Start Work Timer</button>
        </div>
        <div class="col">
            <input class="form-control" type="number" v-model="workTimer">
        </div>
        <div class="col">
            <button class="btn btn-block btn-warning">Start Break Timer</button>
        </div>
        <div class="col">
            <input class="form-control" type="number" v-model="breakTimer">
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            workTimer: 0,
            breakTimer: 0
        }
    }
}
</script>
