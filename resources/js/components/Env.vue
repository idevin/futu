<script>

export default {
    data() {
        return {
            isLoading: true,
            prefix: process.env.MIX_APP_ENV !== 'local' ? '/blog' : ''
        }
    },
    methods: {
        prefix() {
            return this.prefix
        }
    }
}
</script>
