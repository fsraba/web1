<template>
  <v-app :dark="siteDark">
    <v-navigation-drawer
      persistent
      v-model="drawer"
      :mini-variant.sync="mini"
      enable-resize-watcher
      fixed
      app
    >
      <v-toolbar flat class="transparent">
        <v-list class="pa-0">
          <v-list-tile avatar>
            <v-list-tile-avatar>
              <v-badge
                overlap
                color="orange"
              >
                <!-- <v-icon
                  slot="badge"
                  dark
                  small
                >notifications</v-icon> -->
                <v-icon
                  large
                  color="grey darken-1"
                >
                  account_box
                </v-icon>
              </v-badge>
            </v-list-tile-avatar>
            <v-list-tile-content>
              <!-- <v-list-tile-title>{{ `${$user.name} 님 (${$user.job})` }}</v-list-tile-title> -->
              <v-list-tile-title>사용자</v-list-tile-title>

            </v-list-tile-content>
            <v-list-tile-action>
              <v-btn icon @click.native.stop="mini = !mini">
                <v-icon>chevron_left</v-icon>
              </v-btn>
            </v-list-tile-action>
          </v-list-tile>
        </v-list>
      </v-toolbar>
      <v-list>
        <v-list-group
          v-for="(item, i) in items"
          v-model="item.act"
          :prepend-icon="item.icon"
          :key="i"
          no-action
        >
          <v-list-tile slot="activator">
            <!-- <v-list-tile-title>{{item.title}}</v-list-tile-title> -->
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile
            v-for="subItem in item.subItems"
            :key="subItem.title"
            :to="subItem.to"
          >
            <v-list-tile-content>
              <v-list-tile-title>{{ subItem.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list-group>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar
      app
    >
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title v-text="siteTitle"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items>
        <v-menu bottom left>
          <v-btn icon slot="activator">
            <v-icon>more_vert</v-icon>
          </v-btn>
          <v-list>
            <template v-if="!$store.state.token">
              <v-list-tile  @click="$router.push('/sign')">
                <v-list-tile-title>로그인</v-list-tile-title>
              </v-list-tile>
              <v-list-tile  @click="$router.push('/register')">
                <v-list-tile-title>회원가입</v-list-tile-title>
              </v-list-tile>
            </template>
            <v-list-tile v-else @click="signOut">
              <v-list-tile-title>로그아웃</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
      </v-toolbar-items>
    </v-toolbar>
    <v-content>
      <router-view/>
    </v-content>
    <v-footer app>
      <v-spacer></v-spacer>
      <span>{{siteCopyright}} &nbsp;</span>
    </v-footer>
    <v-snackbar
      v-model="$store.state.sb.act"
      :color="$store.state.sb.color"
    >
      {{ $store.state.sb.msg }}
      <v-btn
        flat
        @click="$store.commit('pop', { act: false })"
      >
        닫기
      </v-btn>
    </v-snackbar>
  </v-app>
</template>

<script>

export default {
  name: 'App',
  data () {
    return {
      drawer: null,
      mini: false,
      siteTitle: '기다리는중',
      siteCopyright: '기다리는중',
      siteDark: false,
      items: [
        {
          icon: 'school',
          title: '학교',
          act: true,
          subItems: [
            {
              title: '학교 소개',
              to: {
                path: '/'
              }
            }
          ]
        },
        {
          icon: 'chat',
          title: '게시판',
          subItems: [

          ]
        },
        {
          icon: 'pan_tool',
          title: '레벨테스트',
          subItems: [
            {
              title: '손님용 페이지',
              to: {
                path: '/test/lv3'
              }
            },
            {
              title: '일반유저용 페이지',
              to: {
                path: '/test/lv2'
              }
            },
            {
              title: '슈퍼유저용 페이지',
              to: {
                path: '/test/lv1'
              }
            },
            {
              title: '관리자용 페이지',
              to: {
                path: '/test/lv0'
              }
            }
          ]
        },
        {
          icon: 'select_all',
          title: '관리메뉴',
          subItems: [
            {
              title: '사용자관리',
              to: {
                path: '/manage/users'
              }
            },
            {
              title: '페이지관리',
              to: {
                path: '/manage/pages'
              }
            },
            {
              title: '사이트관리',
              to: {
                path: '/manage/sites'
              }
            },
            {
              title: '게시판관리',
              to: {
                path: '/manage/boards'
              }
            }
          ]
        },
        {
          icon: 'donut_large',
          title: 'Reference_site',
          subItems: [
            {
              title: 'Reference_site1',
              to: {
                path: '/refer_site/refer1'
              }
            },
            {
              title: 'Reference_site2',
              to: {
                path: '/refer_site/refer2'
              }
            }
          ]
        },
        {
          icon: 'chat',
          title: 'Professional_book',
          subItems: [
            {
              title: 'professional_book',
              to: {
                path: '/professional_book'
              }
            }
          ]
        },
        {
          icon: 'pan_tool',
          title: 'Educational_facilities',
          subItems: [
            {
              title: 'edu_facilities1',
              to: {
                path: '/educational_facilities/edu_facilities1'
              }
            },
            {
              title: 'edu_facilities2',
              to: {
                path: '/educational_facilities/edu_facilities2'
              }
            },
            {
              title: 'edu_facilities3',
              to: {
                path: '/educational_facilities/edu_facilities3'
              }
            }
          ]
        },
        {
          icon: 'settings',
          title: 'Corporation',
          subItems: [
            {
              title: 'corporation1',
              to: {
                path: '/corporation/corporation1'
              }
            },
            {
              title: 'corporation2',
              to: {
                path: '/corporation/corporation2'
              }
            }
          ]
        },
        {
          icon: 'widgets',
          title: 'Conference_seminine',
          subItems: [
            {
              title: 'confer_semi1',
              to: {
                path: '/confer_semi/confer_semi1'
              }
            },
            {
              title: 'confer_semi2',
              to: {
                path: '/confer_semi/confer_semi2'
              }
            }
          ]
        },
        {
          icon: 'games',
          title: 'War_game',
          subItems: [
            {
              title: 'web',
              to: {
                path: '/war_game/web'
              }
            },
            {
              title: 'forensics',
              to: {
                path: '/war_game/forensics'
              }
            },
            {
              title: 'misc',
              to: {
                path: '/war_game/misc'
              }
            }
          ]
        },
        {
          icon: 'account_tree',
          title: 'Contest',
          subItems: [
            {
              title: 'contest1',
              to: {
                path: '/contest/contest1'
              }
            },
            {
              title: 'contest2',
              to: {
                path: '/contest/contest2'
              }
            },
            {
              title: 'contest3',
              to: {
                path: '/contest/contest3'
              }
            }
          ]
        },
        {
          icon: 'security',
          title: 'Security_term',
          subItems: [
            {
              title: 'security_term1',
              to: {
                path: '/security_term/security_term1'
              }
            },
            {
              title: 'security_term2',
              to: {
                path: '/security_term/security_term2'
              }
            }
          ]
        }
      ],
      title: this.$apiRootPath
    }
  },
  mounted () {
    this.getSite()
    this.getBoards()
  },
  methods: {
    signOut () {
      // localStorage.removeItem('token')
      this.$store.commit('delToken')
      this.$router.push('/')
    },
    getSite () {
      this.$axios.get('/site')
        .then(r => {
          this.siteTitle = r.data.d.title
          this.siteCopyright = r.data.d.copyright
          this.siteDark = r.data.d.dark
        })
        .catch(e => {
          if (!e.response) this.$store.commit('pop', { msg: e.message, color: 'warning' })
        })
    },
    getBoards () {
      this.$axios.get('/board/list')
        .then(({ data }) => {
          data.ds.forEach(v => {
            this.items[1].subItems.push({
              title: v.title,
              to: {
                path: `/board/${v.name}`
              }
            })
          })
        })
        .catch(e => {
          if (!e.response) this.$store.commit('pop', { msg: e.message, color: 'warning' })
        })
    }

  }
}
</script>
<style>
/* .v-datatable__actions__range-controls {
  display: none;
} */
</style>
