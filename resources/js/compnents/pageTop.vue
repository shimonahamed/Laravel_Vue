<template>
    <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">{{$route.meta.pagetitle}}</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a @click="openModal()" class="btn btn-primary btn-round"><i class="fas fa-plus"></i>Add</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "pageTop"
    }
</script>

<style scoped>

</style>