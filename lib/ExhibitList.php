<?php

namespace BCLib;

class ExhibitList
{
    /**
     * @var \Omeka_Db
     */
    private $db;

    private $exhibits = [];

    public function __construct(\Omeka_Db $db)
    {
        $this->db = $db;
    }

    public function hasExhibits(\Item $item)
    {
        $this->lazyLoad($item);
        return (!empty($this->exhibits));
    }

    public function exhibits(\Item $item) {
        $related_exhibits = [];
        $this->lazyLoad($item);
        foreach ($this->exhibits as $exhibit) {
            $related_exhibits[] = [
                'title' => $exhibit[0]->title,
                'slug' => $exhibit[0]->slug
            ];
        }
        return array_unique($related_exhibits);
    }

    private function load(\Item $item)
    {
        $prefix = $this->db->prefix;

        $select = <<<SQL
    SELECT e.* FROM {$prefix}exhibits AS e
    INNER JOIN {$prefix}exhibit_pages AS ep on ep.exhibit_id = e.id
    INNER JOIN {$prefix}exhibit_page_blocks AS epb ON epb.page_id = ep.id
    INNER JOIN {$prefix}exhibit_block_attachments AS epba ON epba.block_id = epb.id
    WHERE epba.item_id = ?
SQL;
        $this->exhibits[$item->id] = $this->db->getTable('Exhibit')->fetchObjects($select, [$item->id]);
    }

    /**
     * @param \Item $item
     */
    protected function lazyLoad(\Item $item)
    {
        if (!isset($this->exhibits[$item->id])) {
            $this->load($item);
        }
    }

}