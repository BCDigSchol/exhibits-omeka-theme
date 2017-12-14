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

    /**
     * @param \Item $item
     * @return bool
     */
    public function hasExhibits(\Item $item)
    {
        $this->lazyLoad($item);
        return (!empty($this->exhibits));
    }

    /**
     * @param \Item $item
     * @return array
     */
    public function exhibits(\Item $item)
    {
        $related_exhibits = [];
        $this->lazyLoad($item);
        foreach ($this->exhibits as $exhibit) {
            $related_exhibits[] = [
                'title' => $exhibit[0]->title,
                'slug'  => $exhibit[0]->slug
            ];
        }
        return array_unique($related_exhibits);
    }

    /**
     * @return \Exhibit[]
     */
    public function topExhibits()
    {
        $exhibits = [];

        for ($i = 1; $i <= 3; $i++) {
            $slug = get_theme_option("Front exhibit $i");

            if (!$slug) {
                _log("No slug found for Front exhibit $i", \Zend_Log::ERR);
                break;
            }

            $exhibit = $this->getExhibitBySlug($slug);
            if (!$exhibit) {
                _log("No front-page exhibit with slug $slug", \Zend_Log::ERR);
                break;
            }

            $exhibits[] = $exhibit;
        }

        return $exhibits;
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
        $exhibits = $this->db->getTable('Exhibit')->fetchObjects($select, [$item->id]);
        if ($exhibits) {
            $this->exhibits[$item->id] = $exhibits;
        }
    }

    /**
     * @param $slug
     * @return \Exhibit
     */
    private function getExhibitBySlug($slug)
    {
        $exhibits = $this->db->getTable('Exhibit')->findBy(['slug' => $slug]);
        return count($exhibits) ? $exhibits[0] : null;
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