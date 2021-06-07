async function axiosMethod({ path, method, data }) {
    const token = document.head.querySelector('meta[name="csrf-token"]');
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    switch(method) {
      case 'post':
        return await axios.post(path, data);
        break;
      case 'put':
        await axios.put(path, data);
        break;
      case 'delete':
        await axios.delete(path, data);
        break;
      case 'get':
        await axios.get(path, data);
        break;
    }
  }
  