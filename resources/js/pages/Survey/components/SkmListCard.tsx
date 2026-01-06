import {
    Card,
    CardContent,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'

import { Skm } from '@/types'
import { Link } from '@inertiajs/react'

interface Props {
    skms: Skm[]
}

export default function SkmListCard({ skms }: Props) {
    if (skms.length === 0) {
        return (
            <p className="text-sm text-muted-foreground">
                Data OPD tidak tersedia
            </p>
        )
    }

    return (
        <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {skms.map((item) => (
                <Link
                    key={item.id}
                    href={route('survey.services', item.uuid)}
                    className="block"
                >
                    <Card key={item.id} className='backdrop-blur bg-card/75 border-primary/25 hover:border-primary/75 transition duration-300'>
                        <CardContent className='mt-6'>
                            <div>
                                <img src="/assets/images/provinsi-gorontalo.png" alt="" className='h-20' />
                            </div>
                            <h1 className='text-lg text-primary font-medium'>{item.unor.name}</h1>
                            <p className="text-sm text-muted-foreground  line-clamp-1">
                                {item.unor.address}
                            </p>
                        </CardContent>
                    </Card>
                </Link>
            ))}
        </div>
    )
}
