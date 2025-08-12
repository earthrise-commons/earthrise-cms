panel.plugin("earthrise/blocks", {
  blocks: {
    accordion: `<details class="ec-accordion" ><summary class="ec-accordion-title">{{content[0]}}</summary><div v-html="content[1]"></div></details>`,
    resources: `<div class="ec-resources">
    <h2>{{content.title}}</h2>
    <ul class="ec-resources-list">
      <li class="ec-resources-list-item" v-for="item in content.items">
        <p class="ec-resources-list-item-type">({{item.type}})</p>
        <a v-if="item.type === 'url'" :href="item.url">{{item.title}}</a>
        <span v-if="item.type === 'file'">{{item.title}}</span>
      </li>
    
    </ul>
    </div>`,
    twocol: `<div class="ec-twocol" :data-theme="content.theme">

            <div class="ec-twocol-left">
              <template v-for="(block, index) in (content.left || [])" :key="'left-' + index">
                        <k-block :type="block.type" :disabled="true" :content="block.content"  />
                </template>
            </div>
            <div class="ec-twocol-right">
              <template v-for="(block, index) in (content.right || [])" :key="'right-' + index">
                        <k-block :type="block.type" :disabled="true" :content="block.content"  />
                </template>
            </div>

    </div>`,
  },
});
