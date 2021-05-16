<template>
  <div>
    <h1>Branches</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="branch in branches" :key="branch.id">
        <a :href="'/branches/' + branch.id + '/workers'">
          {{ branch.branch_name }}
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
import { ref } from 'vue';
import { onMounted } from 'vue';

export default {
  setup() {
    const URL = 'http://localhost/api/branchesApi.php';
    const branches = ref();
    onMounted(async () => {
      const res = await fetch(URL);
      const data = await res.json();
      branches.value = data;
    });

    return {
      branches,
    };
  },
};
</script>
