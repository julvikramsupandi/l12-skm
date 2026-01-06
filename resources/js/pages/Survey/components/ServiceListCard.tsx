import { Badge } from '@/components/ui/badge'
import {
    Card,
    CardContent,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'

import { Service } from '@/types'
import { Link } from '@inertiajs/react'

interface Props {
    uuid: string
    services: Service[]
}

export default function ServiceListCard({ uuid, services }: Props) {
    if (services.length === 0) {
        return (
            <p className="text-sm text-muted-foreground">
                Data layanan tidak tersedia
            </p>
        )
    }

    return (
        <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {services.map((item) => (
                <Link
                    key={item.id}
                    href={route('survey.form', [uuid, item.id])}
                    className="block"
                >
                    <Card key={item.id} className='backdrop-blur bg-card/75 border-primary/25 hover:border-primary/75 transition duration-300'>
                        <CardContent className='mt-5'>
                            <Badge className={
                                item.service_channel == 'ONLINE'
                                    ? 'bg-green-500'
                                    : item.service_channel == 'OFFLINE'
                                        ? 'bg-slate-500'
                                        : 'bg-primary'
                            }>
                                {item.service_channel}
                            </Badge>
                            <h1 className='text-lg font-medium mt-3'>{item.name}</h1>
                            <p className="text-sm text-muted-foreground line-clamp-1">
                                {item.description}
                            </p>
                        </CardContent>
                    </Card>
                </Link>
            ))}
        </div>
    )
}
