<template>
  <div>
    <h1>List of workers</h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Phone</th>
          <th scope="col">Type</th>
          <th scope="col">Branch</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(worker, index) in workers" :key="worker.id">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ worker.first_name }}</td>
          <td>{{ worker.last_name }}</td>
          <td>{{ worker.phone }}</td>
          <td>{{ worker.category }}</td>
          <td>{{ worker.branch_name }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { ref } from 'vue';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';

export default {
  setup() {
    const route = useRoute();
    const URL =
      'http://localhost/api/workersApi.php?branch_id=' + route.params.id;
    const workers = ref();
    onMounted(async () => {
      const res = await fetch(URL);
      const data = await res.json();
      workers.value = data;
    });

    return {
      workers,
    };
  },
};
</script>
