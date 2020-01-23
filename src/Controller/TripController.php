<?php
/**
 * Created by PhpStorm.
 * User: ovcmike
 * Date: 2020-01-23
 * Time: 16:08
 */

namespace App\Controller;

use App\Entity\PlannedTrip;
use App\Entity\TripPoint;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class TripController extends AbstractController
{
    /**
     * @Route("/debug/")
     */
    public function debug()
    {
        return new Response(
            '<html><head><script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script></head><body>OK</body></html>'
        );
    }

    /**
     * @Route("/getTrip/{id}")
     * @param int $id
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getTrip(int $id, EntityManagerInterface $em)
    {
        /** @var PlannedTrip $trip */
        $trip = $em->find(PlannedTrip::class, $id);
        return $this->json($trip->toArray());
    }

    /**
     * @param array $point_data
     * @return TripPoint
     */
    private function preparePoint(array $point_data): TripPoint
    {
        // Создаем и заполняем объект точки
        $tripPoint = new TripPoint();
        $tripPoint
            ->setLat($point_data['lat'])
            ->setLng($point_data['lng'])
            ->setName($point_data['name'])
            ->setCategory($point_data['category']);
        return $tripPoint;
    }


    /**
     * @param EntityManagerInterface $em
     * @param $trip
     */
    public function deleteExistingPoints(EntityManagerInterface $em, PlannedTrip $trip): void
    {
        // Удаляем те точки, которые привязаны к указанному путешествию
        $em->createQueryBuilder()
            ->delete()
            ->from(TripPoint::class, 'p')
            ->where('p.trip = :trip')
            ->setParameter('trip', $trip)
            ->getQuery()
            ->execute();
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param $trip
     */
    public function updateTrip(Request $request, EntityManagerInterface $em, PlannedTrip $trip): void
    {
        // Установим параметры путешествия
        $trip->setName($request->get("name"));
        $trip->setCity($request->get("city"));
        $trip->setDate($request->get("date"));

        // Создадим новые точки путешествия
        $points = $request->get('points');
        foreach ($points as $point) {
            $tripPoint = $this->preparePoint($point);
            $trip->addPoint($tripPoint);
            $em->persist($tripPoint);
        }
        $em->persist($trip);
    }

    /**
     * @Route("/saveTrip/")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function saveTrip(Request $request, EntityManagerInterface $em)
    {
        $id = $request->get('id');
        // Найдем интересующее нас путешествие

        if (!$id) {
            $trip = new PlannedTrip();
        } else {
            /** @var PlannedTrip $trip */
            $trip = $em->find(PlannedTrip::class, $id);
            // Удалим существующие точки в путешествии
            $this->deleteExistingPoints($em, $trip);
        }

        // Обновим информацию о путешествии
        $this->updateTrip($request, $em, $trip);

        // Запишем изменения в БД
        $em->flush();

        return $this->json(["trip_id" => $trip->getId()]);
    }
}