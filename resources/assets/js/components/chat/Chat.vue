<template lang="html">
    <div class="uk-card uk-card-default uk-card-hover">
        <chat-messages></chat-messages>
        <form class="uk-form uk-padding-small">
            <textarea id="body"
                      rows="5"
                      cols="80"
                      class="uk-textarea"
                      v-model="body"
                      @keydown="handleMessageInput">
            </textarea>
            <span class="uk-text-meta">
                Hit return to send or Ctrl + Return for a new line
            </span>
        </form>
    </div>
</template>

<script>
import Bus from '../../bus.js'
import moment from 'moment'

export default {
    data () {
        return {
            body: null,
            bodyBackUp: null
        }
    },
    methods: {
        handleMessageInput (e) {
            this.bodyBackUp = this.body
            if ( e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                this.send();
            }
        },
        buildTempMessage() {
            let tempId = Date.now();

            return {
                id: tempId,
                body: this.body,
                created_at: moment().utc(0).format('YYYY-MM-DD HH:mm:ss'),
                selfOwned: true,
                user: {
                    name: Laravel.user.name
                }
            }
        },
        send () {
            if ( !this.body || this.body.trim() === '' ) {
                return
            }

            let tempMessage = this.buildTempMessage();

            Bus.$emit('message.added', tempMessage)

            axios.post('/chat/messages', {
                body: this.body.trim()
            }).catch( () => {
                this.body = this.bodyBackUp
                Bus.$emit('message.remove', tempMessage)
            })

            this.body = null
        }
    }
}
</script>
