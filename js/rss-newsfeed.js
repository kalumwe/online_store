import { xml2json } from 'xml-js';

const numberOfFeeds = 2; // Specify the number of feeds to retrieve

fetch('rss.php')
  .then(response => response.text())
  .then(xmlData => {
    const options = {
      compact: true,
      spaces: 4
    };
    
    const jsonData = xml2json(xmlData, options);
    //const jsonData = xmlToJson(xmlData);
    const items = jsonData.rss.channel.item;

    let html = '';
    for (let i = 0; i < numberOfFeeds && i < items.length; i++) {
      const item = items[i];
      html += `<div class="col-sm-6"><div class="post">`;
      html += `<h4><a href="post.php">${item.title._text}</a></h4>`;
      html += '<hr>';
      html += `<p class="intro">${item.description._text}</p>`;
      html += `<p class="read-more"><a href="${item.link._text}" class="btn btn-primary" target="_blank">Continue reading</a></p>`;
      html += '<hr>';
      html += ' </div></div>';
    }

    document.getElementById('blog-homepage').innerHTML = html;
  })
  .catch(error => {
    console.error('Error:', error);
  });


  /*function xmlToJson(xml) {
    const dom = new DOMParser().parseFromString(xml, 'text/xml');
    return JSON.parse(xml2json(dom, { compact: true, spaces: 4 }));
  }*/

  /*function xmlToJson(xml) {
    const dom = new DOMParser().parseFromString(xml, 'text/xml');
    const root = dom.documentElement;
    const result = {};
  
    if (root.hasChildNodes()) {
      parseNode(root, result);
    }
  
    return result;
  }
  
  function parseNode(node, obj) {
    if (node.nodeType === 1) {
      // Element node
      if (node.hasAttributes()) {
        obj['_attributes'] = {};
        const attributes = node.attributes;
        for (let i = 0; i < attributes.length; i++) {
          const attr = attributes[i];
          obj['_attributes'][attr.nodeName] = attr.nodeValue;
        }
      }
    } else if (node.nodeType === 3 || node.nodeType === 4) {
      // Text or CDATA node
      obj['_text'] = node.nodeValue.trim();
      return;
    }
  
    if (node.hasChildNodes()) {
      const children = node.childNodes;
      for (let i = 0; i < children.length; i++) {
        const child = children[i];
        const nodeName = child.nodeName;
  
        if (!obj[nodeName]) {
          obj[nodeName] = [];
        }
  
        const childObj = {};
        parseNode(child, childObj);
        obj[nodeName].push(childObj);
      }
    }
  }*/
  
